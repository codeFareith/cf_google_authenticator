<?php

/* layout.html.twig */
class __TwigTemplate_45e59a2cba9ee212e2b1a31504bc7f22a938a217ca6f8c20f430bd234a6c2697 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'icons' => array($this, 'block_icons'),
            'header' => array($this, 'block_header'),
            'heroUnit' => array($this, 'block_heroUnit'),
            'content' => array($this, 'block_content'),
            'footer' => array($this, 'block_footer'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0\"/>
    <meta charset=\"utf-8\"/>
    <title>";
        // line 6
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
    <meta name=\"author\" content=\"";
        // line 7
        echo twig_escape_filter($this->env, ($context["author"] ?? null), "html", null, true);
        echo "\"/>
    <meta name=\"description\" content=\"\"/>

    ";
        // line 10
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 13
        echo "
    ";
        // line 14
        $this->displayBlock('javascripts', $context, $blocks);
        // line 25
        echo "
    ";
        // line 26
        $this->displayBlock('icons', $context, $blocks);
        // line 32
        echo "</head>
<body>

    ";
        // line 35
        $this->displayBlock('header', $context, $blocks);
        // line 105
        echo "
    <div id=\"___\" class=\"container\">
        <noscript>
            <div class=\"alert alert-warning\">
                Javascript is disabled; several features are only available if Javascript is enabled.
            </div>
        </noscript>

        ";
        // line 113
        $this->displayBlock('heroUnit', $context, $blocks);
        // line 114
        echo "
        ";
        // line 115
        $this->displayBlock('content', $context, $blocks);
        // line 116
        echo "    </div>

    ";
        // line 118
        $this->displayBlock('footer', $context, $blocks);
        // line 126
        echo "</body>
</html>
";
    }

    // line 6
    public function block_title($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, $this->getAttribute(($context["project"] ?? null), "name", array()), "html", null, true);
    }

    // line 10
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 11
        echo "        <link href=\"";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array("css/template.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" media=\"all\"/>
    ";
    }

    // line 14
    public function block_javascripts($context, array $blocks = array())
    {
        // line 15
        echo "        <!--[if lt IE 9]>
        <script src=\"https://html5shim.googlecode.com/svn/trunk/html5.js\" type=\"text/javascript\"></script>
        <![endif]-->
        <script src=\"";
        // line 18
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array("js/jquery-1.7.1.min.js")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        <script src=\"";
        // line 19
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array("js/jquery-ui-1.8.2.custom.min.js")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        <script src=\"";
        // line 20
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array("js/jquery.mousewheel.min.js")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        <script src=\"";
        // line 21
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array("js/bootstrap.js")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        <script src=\"";
        // line 22
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array("js/template.js")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        <script src=\"";
        // line 23
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array("js/prettify/prettify.min.js")), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
    ";
    }

    // line 26
    public function block_icons($context, array $blocks = array())
    {
        // line 27
        echo "        <link rel=\"shortcut icon\" href=\"";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array("img/favicon.ico")), "html", null, true);
        echo "\"/>
        <link rel=\"apple-touch-icon\" href=\"";
        // line 28
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array("img/apple-touch-icon.png")), "html", null, true);
        echo "\"/>
        <link rel=\"apple-touch-icon\" sizes=\"72x72\" href=\"";
        // line 29
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array("img/apple-touch-icon-72x72.png")), "html", null, true);
        echo "\"/>
        <link rel=\"apple-touch-icon\" sizes=\"114x114\" href=\"";
        // line 30
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array("img/apple-touch-icon-114x114.png")), "html", null, true);
        echo "\"/>
    ";
    }

    // line 35
    public function block_header($context, array $blocks = array())
    {
        // line 36
        echo "    <div class=\"navbar navbar-fixed-top\">
        <div class=\"navbar-inner\">
            <div class=\"container\">
                <a class=\"btn btn-navbar\" data-toggle=\"collapse\" data-target=\".nav-collapse\">
                    <span class=\"icon-bar\"></span> <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span> </a>
                <a class=\"brand\" href=\"";
        // line 42
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array("index.html")), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["project"] ?? null), "name", array()), "html", null, true);
        echo "</a>

                <div class=\"nav-collapse\">
                    <ul class=\"nav\">
                        <li class=\"dropdown\">
                            <a href=\"#api\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">
                                API Documentation <b class=\"caret\"></b>
                            </a>
                            <ul class=\"dropdown-menu\">
                                ";
        // line 51
        if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute(($context["project"] ?? null), "namespace", array()), "children", array())) > 0)) {
            // line 52
            echo "                                    <li><a>Namespaces</a></li>
                                    ";
            // line 53
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute(($context["project"] ?? null), "namespace", array()), "children", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["namespace"]) {
                // line 54
                echo "                                    <li><a href=\"";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array($context["namespace"])), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($context["namespace"], "name", array()), "html", null, true);
                echo "</a></li>
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['namespace'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 56
            echo "                                ";
        }
        // line 57
        echo "                                ";
        if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute(($context["project"] ?? null), "index", array()), "packages", array())) > 0)) {
            // line 58
            echo "                                    <li><a>Packages</a></li>
                                ";
        }
        // line 60
        echo "                            </ul>
                        </li>
                        <li class=\"dropdown\" id=\"charts-menu\">
                            <a href=\"#charts\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">
                                Charts <b class=\"caret\"></b>
                            </a>
                            <ul class=\"dropdown-menu\">
                                <li>
                                    <a href=\"";
        // line 68
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array("graph_class.html")), "html", null, true);
        echo "\">
                                        <i class=\"icon-list-alt\"></i>&#160;Class hierarchy diagram
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class=\"dropdown\" id=\"reports-menu\">
                            <a href=\"#reports\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">
                                Reports <b class=\"caret\"></b>
                            </a>
                            <ul class=\"dropdown-menu\">
                                <li>
                                    <a href=\"";
        // line 80
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array("errors.html")), "html", null, true);
        echo "\">
                                        <i class=\"icon-list-alt\"></i>&#160;Errors
                                    </a>
                                </li>
                                <li>
                                    <a href=\"";
        // line 85
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array("markers.html")), "html", null, true);
        echo "\">
                                        <i class=\"icon-list-alt\"></i>&#160;Markers
                                    </a>
                                </li>
                                <li>
                                    <a href=\"";
        // line 90
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array("deprecated.html")), "html", null, true);
        echo "\">
                                        <i class=\"icon-list-alt\"></i>&#160;Deprecated
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class=\"go_to_top\">
            <a href=\"#___\" style=\"color: inherit\">Back to top&#160;&#160;<i class=\"icon-upload icon-white\"></i></a>
        </div>
    </div>
    ";
    }

    // line 113
    public function block_heroUnit($context, array $blocks = array())
    {
    }

    // line 115
    public function block_content($context, array $blocks = array())
    {
    }

    // line 118
    public function block_footer($context, array $blocks = array())
    {
        // line 119
        echo "    <footer class=\"span12\">
            Template is built using <a href=\"http://twitter.github.com/bootstrap/\">Twitter Bootstrap 2</a> and icons provided by
            <a href=\"http://glyphicons.com/\">Glyphicons</a>.<br/>
            Documentation is powered by <a href=\"http://www.phpdoc.org/\">phpDocumentor ";
        // line 122
        echo twig_escape_filter($this->env, ($context["version"] ?? null), "html", null, true);
        echo "</a> and<br/>
            generated on ";
        // line 123
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, ($context["now"] ?? null), "r"), "html", null, true);
        echo ".<br/>
    </footer>
    ";
    }

    public function getTemplateName()
    {
        return "layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  301 => 123,  297 => 122,  292 => 119,  289 => 118,  284 => 115,  279 => 113,  260 => 90,  252 => 85,  244 => 80,  229 => 68,  219 => 60,  215 => 58,  212 => 57,  209 => 56,  198 => 54,  194 => 53,  191 => 52,  189 => 51,  175 => 42,  167 => 36,  164 => 35,  158 => 30,  154 => 29,  150 => 28,  145 => 27,  142 => 26,  136 => 23,  132 => 22,  128 => 21,  124 => 20,  120 => 19,  116 => 18,  111 => 15,  108 => 14,  101 => 11,  98 => 10,  92 => 6,  86 => 126,  84 => 118,  80 => 116,  78 => 115,  75 => 114,  73 => 113,  63 => 105,  61 => 35,  56 => 32,  54 => 26,  51 => 25,  49 => 14,  46 => 13,  44 => 10,  38 => 7,  34 => 6,  27 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "layout.html.twig", "phar:///Applications/MAMP/htdocs/TYPO3/Extensions/cf_google_authenticator/phpDocumentor.phar/src/phpDocumentor/../../data/templates/../templates/responsive-twig/layout.html.twig");
    }
}
