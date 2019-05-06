<?php

/* /reports/deprecated.html.twig */
class __TwigTemplate_84b7f548e275166d93e96e243b59f320b0939ac2059a033542f5f7993ef3cb1f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout.html.twig", "/reports/deprecated.html.twig", 1);
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
        echo " &raquo; Deprecated elements
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
        // line 13
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute(($context["project"] ?? null), "indexes", array()), "elements", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["element"]) {
            if ($this->getAttribute($context["element"], "deprecated", array())) {
                // line 14
                echo "                    ";
                if (($this->getAttribute($this->getAttribute($context["element"], "file", array()), "path", array()) != ($context["previousPath"] ?? null))) {
                    // line 15
                    echo "                        <li><a href=\"#";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["element"], "file", array()), "path", array()), "html", null, true);
                    echo "\"><i class=\"icon-file\"></i> ";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["element"], "file", array()), "path", array()), "html", null, true);
                    echo "</a></li>
                    ";
                }
                // line 17
                echo "                    ";
                $context["previousPath"] = $this->getAttribute($this->getAttribute($context["element"], "file", array()), "path", array());
                // line 18
                echo "                ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['element'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 19
        echo "            </ul>
        </div>

        <div class=\"span8\">
            <ul class=\"breadcrumb\">
                <li><a href=\"";
        // line 24
        if ((call_user_func_array($this->env->getFunction('path')->getCallable(), array("/")) == "")) {
            echo "?";
        } else {
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array("/")), "html", null, true);
        }
        echo "\"><i class=\"icon-stop\"></i></a><span class=\"divider\">\\</span></li>
                <li>Deprecated elements</li>
            </ul>

            <div id=\"marker-accordion\">
                ";
        // line 29
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute(($context["project"] ?? null), "indexes", array()), "elements", array()));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["element"]) {
            if ($this->getAttribute($context["element"], "deprecated", array())) {
                // line 30
                echo "                    <a name=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["element"], "file", array()), "path", array()), "html", null, true);
                echo "\" id=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["element"], "file", array()), "path", array()), "html", null, true);
                echo "\"></a>
                    <h3>
                        <i class=\"icon-file\"></i> ";
                // line 32
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["element"], "file", array()), "path", array()), "html", null, true);
                echo "
                        <span class=\"pull-right badge badge-info\">";
                // line 33
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["element"], "tags", array()), "deprecated", array()), "count", array()), "html", null, true);
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
                // line 42
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($context["element"], "tags", array()), "deprecated", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                    // line 43
                    echo "                                <tr>
                                    <td>";
                    // line 44
                    echo twig_escape_filter($this->env, $this->getAttribute($context["element"], "name", array()), "html", null, true);
                    echo "</td>
                                    <td>";
                    // line 45
                    echo twig_escape_filter($this->env, $this->getAttribute($context["element"], "line", array()), "html", null, true);
                    echo "</td>
                                    <td>";
                    // line 46
                    echo twig_escape_filter($this->env, $this->getAttribute($context["element"], "description", array()), "html", null, true);
                    echo "</td>
                                </tr>
                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 49
                echo "                        </table>
                    </div>
                ";
                $context['_iterated'] = true;
            }
        }
        if (!$context['_iterated']) {
            // line 52
            echo "                    <div class=\"alert alert-info\">No deprecated elements have been found in this project.</div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['element'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 54
        echo "            </div>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "/reports/deprecated.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  163 => 54,  156 => 52,  148 => 49,  139 => 46,  135 => 45,  131 => 44,  128 => 43,  124 => 42,  112 => 33,  108 => 32,  100 => 30,  94 => 29,  82 => 24,  75 => 19,  68 => 18,  65 => 17,  57 => 15,  54 => 14,  49 => 13,  42 => 8,  39 => 7,  32 => 4,  29 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "/reports/deprecated.html.twig", "phar:///Applications/MAMP/htdocs/TYPO3/Extensions/cf_google_authenticator/phpDocumentor.phar/src/phpDocumentor/../../data/templates/../templates/responsive-twig//reports/deprecated.html.twig");
    }
}
