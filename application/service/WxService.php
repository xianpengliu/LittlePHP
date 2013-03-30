<?php
/**
 * Created by JetBrains PhpStorm.
 * User: tom
 * Date: 13-3-19
 * Time: PM7:48
 */
class WxService
{
    static public function process($userInputXml)
    {
        $xml        = simplexml_load_string($userInputXml, 'SimpleXMLElement', LIBXML_NOCDATA);
        $clientName = $xml->FromUserName;
        $hostName   = $xml->ToUserName;
        $userInput  = trim($xml->Content);

        if(! empty($userInput))
        {
            //$resultXml = Imp::formatTextOutput($clientName, $hostName, Imp::play($clientName, $userInput));
//            $resultXml = Imp::formatMusicOutput($clientName, $hostName, "春暖花开", "那英",
//              "http://zhangmenshiting.baidu.com/data2/music/34185817/3418237864800128.mp3?xcode=3498d645ef45003aaf56b6d72d12c4b0",
//              "http://zhangmenshiting.baidu.com/data2/music/34185816/3418237864800192.mp3?xcode=6e1de8164eae8c2a3c350b4e1ff22833");

            $articleArray = array();

            for ($i=0; $i<3; $i++)
            {
                $article['title']       = "第" . $i . "个标题";
                $article['description'] = "第" . $i . "个的描述";
                $article['picUrl']      = 'http://a.xnimg.cn/n/apps/login/v6/res/reg-bg.jpg';
                $article['url']         = 'http://www.liuxianpeng.com/?p=124';

                $articleArray []= $article;
            }

            $resultXml = Imp::formatNewsOutput($clientName, $hostName, $articleArray);

            log_message('debug', 'resultXml:' . $resultXml);

            return $resultXml;
        }
        else
        {
            return Imp::formatTextOutput($clientName, $hostName, "你好...");
        }
    }

    static private function play($userWeixinId, $userInput)
    {
        $url = "http://sandbox.api.simsimi.com/request.p?key=296bcd65-d061-45f7-a79d-0f4a617869a7&lc=ch&ft=1.0&text=" . urlencode($userInput);
        $resultJson = file_get_contents($url);
        //$getcontent = iconv("gb2312", "utf-8",$contents);

        $resultArray = json_decode($resultJson);
        if ($resultArray->result == 100)
        {
            return $resultArray->response;
        }
        else
        {
            return "小黄鸡好像悲剧了...";
        }
    }

    static private function formatTextOutput($toUserName, $fromUserName, $content)
    {
        $textTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[text]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    <FuncFlag>0</FuncFlag>
                    </xml>";

        $time = time();

        $resultStr = sprintf($textTpl, $toUserName, $fromUserName, $time, $content);
        return $resultStr;
    }

    static private function formatMusicOutput($toUserName, $fromUserName, $title, $description, $musicUrl, $hqMusicUrl)
    {
        $textTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[music]]></MsgType>
                    <Music>
                    <Title><![CDATA[%s]]></Title>
                    <Description><![CDATA[%s]]></Description>
                    <MusicUrl><![CDATA[%s]]></MusicUrl>
                    <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
                    </Music>
                    <FuncFlag>0</FuncFlag>
                    </xml>";

        $resultStr = sprintf($textTpl, $toUserName, $fromUserName, time(), $title, $description, $musicUrl, $hqMusicUrl);
        return $resultStr;
    }

    static private function formatNewsOutput($toUserName, $fromUserName, $articleArray)
    {
        if (count($articleArray) == 0)
        {
            return "";
        }

        $textTplStart = "<xml>
					        <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[news]]></MsgType>
                            <ArticleCount>%s</ArticleCount>
                            <Articles>";

        $resultString = sprintf($textTplStart, $toUserName, $fromUserName, time(), count($articleArray));

        foreach ($articleArray as $article)
        {
            $articleTpl = "<item>
                             <Title><![CDATA[%s]]></Title>
                             <Description><![CDATA[%s]]></Description>
                             <PicUrl><![CDATA[%s]]></PicUrl>
                             <Url><![CDATA[%s]]></Url>
                           </item>";

            $resultString = $resultString . sprintf($articleTpl, $article['title'], $article['description'], $article['picUrl'], $article['url']);
        }

        $textTplEnd = "</Articles>
                       <FuncFlag>0</FuncFlag>
                    </xml>";

        $resultString = $resultString . $textTplEnd;

        return $resultString;
    }
}