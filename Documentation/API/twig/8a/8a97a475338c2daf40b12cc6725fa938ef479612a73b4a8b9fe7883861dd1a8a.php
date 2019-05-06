<?php

/* /graphs/class.html.twig */
class __TwigTemplate_aca13670f45fb3e9356c92859a34c82b0642b1e160ed2c991dc23f65e22a2a2f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout.html.twig", "/graphs/class.html.twig", 1);
        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "    <div class=\"row\">
        <div class=\"span12\">
            <div class=\"well wrapper\">
                <div id=\"viewer\" class=\"viewer\"></div>
            </div>
        </div>
    </div>

    <script src=\"";
        // line 12
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array("js/jquery.iviewer.min.js")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    <script type=\"text/javascript\">
        \$(window).resize(function(){
            \$(\"#viewer\").height(\$(window).height() - 260);
        });

        \$(document).ready(function() {
            \$(\"#viewer\").iviewer({src: '";
        // line 19
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array("classes.svg")), "html", null, true);
        echo "', zoom_animation: false});
            \$('#viewer img').bind('dragstart', function(event){
                event.preventDefault();
            });
        });
    </script>
";
    }

    public function getTemplateName()
    {
        return "/graphs/class.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  51 => 19,  41 => 12,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "/graphs/class.html.twig", "phar:///Applications/MAMP/htdocs/TYPO3/Extensions/cf_google_authenticator/phpDocumentor.phar/src/phpDocumentor/../../data/templates/../templates/responsive-twig//graphs/class.html.twig");
    }
}
