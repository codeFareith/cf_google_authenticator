<?php

/* /reports/markers.html.twig */
class __TwigTemplate_c682d446dc9e48dd3b3b6af03dcc78a7e5d9e8485df1e8e90048c277e3320ee6 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout.html.twig", "/reports/markers.html.twig", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
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
    public function block_title($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["project"] ?? null), "title", array()), "html", null, true);
        echo " &raquo; Markers
";
    }

    // line 7
    public function block_content($context, array $blocks = array())
    {
        // line 8
        echo "    <div class=\"row\">
        <div class=\"span4\">
            <ul class=\"side-nav nav nav-list\">
                <li class=\"nav-header\">Navigation</li>
                ";
        // line 12
        $context["markerCount"] = 0;
        // line 13
        echo "                ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["project"] ?? null), "files", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["file"]) {
            // line 14
            echo "                    ";
            if ((twig_length_filter($this->env, $this->getAttribute($context["file"], "markers", array())) > 0)) {
                // line 15
                echo "                    <li><a href=\"#";
                echo twig_escape_filter($this->env, $this->getAttribute($context["file"], "path", array()), "html", null, true);
                echo "\"><i class=\"icon-file\"></i> ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["file"], "path", array()), "html", null, true);
                echo "</a></li>
                    ";
            }
            // line 17
            echo "                    ";
            $context["markerCount"] = (($context["markerCount"] ?? null) + twig_length_filter($this->env, $this->getAttribute($context["file"], "markers", array())));
            // line 18
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['file'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 19
        echo "            </ul>
        </div>

        <div class=\"span8\">

            <ul class=\"breadcrumb\">
                <li><a href=\"";
        // line 25
        if ((call_user_func_array($this->env->getFunction('path')->getCallable(), array("/")) == "")) {
            echo "?";
        } else {
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array("/")), "html", null, true);
        }
        echo "\"><i class=\"icon-map-marker\"></i></a><span class=\"divider\">\\</span></li>
                <li>Markers</li>
            </ul>

            ";
        // line 29
        if ((($context["markerCount"] ?? null) <= 0)) {
            // line 30
            echo "                <div class=\"alert alert-info\">No markers have been found in this project.</div>
            ";
        }
        // line 32
        echo "
            <div id=\"marker-accordion\">
                ";
        // line 34
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["project"] ?? null), "files", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["file"]) {
            // line 35
            echo "                    ";
            if ((twig_length_filter($this->env, $this->getAttribute($context["file"], "markers", array())) > 0)) {
                // line 36
                echo "                        <div class=\"package-contents\">
                            <a name=\"";
                // line 37
                echo twig_escape_filter($this->env, $this->getAttribute($context["file"], "path", array()), "html", null, true);
                echo "\" id=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["file"], "path", array()), "html", null, true);
                echo "\"></a>
                            <h3>
                            <i class=\"icon-file\"></i>
                                ";
                // line 40
                echo twig_escape_filter($this->env, $this->getAttribute($context["file"], "path", array()), "html", null, true);
                echo "
                                <span class=\"pull-right badge badge-info\">";
                // line 41
                echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute($context["file"], "markers", array())), "html", null, true);
                echo "</span>
                            </h3>
                            <div>
                                <table class=\"table markers table-bordered\">
                                    <tr>
                                        <th>Type</th>
                                        <th>Line</th>
                                        <th>Description</th>
                                    </tr>
                                    ";
                // line 50
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["file"], "markers", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["marker"]) {
                    // line 51
                    echo "                                        <tr>
                                            <td>";
                    // line 52
                    echo twig_escape_filter($this->env, $this->getAttribute($context["marker"], "type", array()), "html", null, true);
                    echo "</td>
                                            <td>";
                    // line 53
                    echo twig_escape_filter($this->env, $this->getAttribute($context["marker"], "line", array()), "html", null, true);
                    echo "</td>
                                            <td>";
                    // line 54
                    echo twig_escape_filter($this->env, $this->getAttribute($context["marker"], "message", array()), "html", null, true);
                    echo "</td>
                                        </tr>
                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['marker'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 57
                echo "                                </table>
                            </div>
                        </div>
                    ";
            }
            // line 61
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['file'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 62
        echo "            </div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "/reports/markers.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  174 => 62,  168 => 61,  162 => 57,  153 => 54,  149 => 53,  145 => 52,  142 => 51,  138 => 50,  126 => 41,  122 => 40,  114 => 37,  111 => 36,  108 => 35,  104 => 34,  100 => 32,  96 => 30,  94 => 29,  83 => 25,  75 => 19,  69 => 18,  66 => 17,  58 => 15,  55 => 14,  50 => 13,  48 => 12,  42 => 8,  39 => 7,  32 => 4,  29 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "/reports/markers.html.twig", "phar:///Applications/MAMP/htdocs/TYPO3/Extensions/cf_google_authenticator/phpDocumentor.phar/src/phpDocumentor/../../data/templates/../templates/responsive-twig//reports/markers.html.twig");
    }
}
