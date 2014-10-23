<?php

/**
 * MasterClass class file.
 * @author egoss <dev@egoss.ru>
 */
class Disqus extends CWidget
{
    public $shortname = 'test';
    public $identifier = false;
    public $title = false;
    public $url = false;
    public $category_id = false;

    public function run()
    {
        /**
         * @var CClientScript $cs
         */
        $cs = Yii::app()->clientScript;
        $scriptText = "var disqus_shortname = \"{$this->shortname}\";";
        if ($this->identifier) {
            $scriptText .= "var disqus_identifier = \"{$this->identifier}\";";
        }
        if ($this->title) {
            $scriptText .= "var disqus_title = \"{$this->title}\";";
        }
        if ($this->url) {
            $scriptText .= "var disqus_url = \"{$this->url}\";";
        }
        if ($this->category_id) {
            $scriptText .= "var disqus_category_id = \"{$this->category_id}\";";
        }
        $scriptText .= '
           (function() {
               var dsq = document.createElement("script");
               dsq.type = "text/javascript";
               dsq.async = true;
               dsq.src = "//" + disqus_shortname + ".disqus.com/embed.js";
               (document.getElementsByTagName("head")[0] || document.getElementsByTagName("body")[0]).appendChild(dsq);
           })();
        ';
        $cs->registerScript( 'disqus', $scriptText, CClientScript::POS_END );
        echo '<div id="disqus_thread"></div>';
        return;
    }
}