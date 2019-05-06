<?php

/* /reports/errors.html.twig */
class __TwigTemplate_538323c0a708e97168bcd9edb654f4fb82fe0c2e118b7e9004d37d8975ac5250 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout.html.twig", "/reports/errors.html.twig", 1);
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
        echo " &raquo; Compilation errors
";
    }

    // line 7
    public function block_content($context, array $blocks = array())
    {
        // line 8
        echo "<div class=\"row\">
        <div class=\"span4\">

            <ul class=\"side-nav nav nav-list\">
                <li class=\"nav-header\">Filter type</li>
                <li>
                    <div class=\"btn-group type-filter\" data-toggle=\"buttons-checkbox\">
                        <button class=\"btn critical\">Critical</button>
                        <button class=\"btn error\">Error</button>
                        <button class=\"btn notice\">Notice</button>
                    </div>
                </li>
                <li class=\"nav-header\">Navigation</li>
                ";
        // line 21
        $context["errorCount"] = 0;
        // line 22
        echo "                ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["project"] ?? null), "files", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["file"]) {
            // line 23
            echo "                    ";
            if ((twig_length_filter($this->env, $this->getAttribute($context["file"], "allerrors", array())) > 0)) {
                // line 24
                echo "                        <li><a href=\"#";
                echo twig_escape_filter($this->env, $this->getAttribute($context["file"], "path", array()), "html", null, true);
                echo "\"><i class=\"icon-file\"></i> ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["file"], "path", array()), "html", null, true);
                echo "</a></li>
                    ";
            }
            // line 26
            echo "                    ";
            $context["errorCount"] = (($context["errorCount"] ?? null) + twig_length_filter($this->env, $this->getAttribute($context["file"], "allerrors", array())));
            // line 27
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['file'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 28
        echo "            </ul>
        </div>

        <div class=\"span8\">
            <ul class=\"breadcrumb\">
                <li><a href=\"";
        // line 33
        if ((call_user_func_array($this->env->getFunction('path')->getCallable(), array("/")) == "")) {
            echo "?";
        } else {
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array("/")), "html", null, true);
        }
        echo "\"><i class=\"icon-remove-sign\"></i></a><span class=\"divider\">\\</span></li>
                <li>Compilation Errors</li>
            </ul>

            ";
        // line 37
        if ((($context["errorCount"] ?? null) <= 0)) {
            // line 38
            echo "                <div class=\"alert alert-info\">No errors have been found in this project.</div>
            ";
        }
        // line 40
        echo "
            ";
        // line 41
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["project"] ?? null), "files", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["file"]) {
            // line 42
            echo "                <div class=\"package-contents\">
                    ";
            // line 43
            if ((twig_length_filter($this->env, $this->getAttribute($context["file"], "allerrors", array())) > 0)) {
                // line 44
                echo "                        <a name=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["file"], "path", array()), "html", null, true);
                echo "\" id=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["file"], "path", array()), "html", null, true);
                echo "\"></a>
                        <h3>
                            <i class=\"icon-file\"></i>
                            ";
                // line 47
                echo twig_escape_filter($this->env, $this->getAttribute($context["file"], "path", array()), "html", null, true);
                echo "
                            <span class=\"pull-right badge badge-info\">";
                // line 48
                echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute($context["file"], "allerrors", array())), "html", null, true);
                echo "</span>
                        </h3>
                        <div>
                            <table class=\"table markers table-bordered\">
                                <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Line</th>
                                    <th>Description</th>
                                </tr>
                                </thead>
                                <tbody>
                                ";
                // line 60
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["file"], "allerrors", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["error"]) {
                    // line 61
                    echo "                                    <tr class=\"";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["error"], "severity", array()), "html", null, true);
                    echo "\">
                                        <td>";
                    // line 62
                    echo twig_escape_filter($this->env, $this->getAttribute($context["error"], "severity", array()), "html", null, true);
                    echo "</td>
                                        <td>";
                    // line 63
                    echo twig_escape_filter($this->env, $this->getAttribute($context["error"], "line", array()), "html", null, true);
                    echo "</td>
                                        <td>";
                    // line 64
                    echo twig_escape_filter($this->env, call_user_func_array($this->env->getFilter('trans')->getCallable(), array($this->getAttribute($context["error"], "code", array()), $this->getAttribute($context["error"], "context", array()))), "html", null, true);
                    echo "</td>
                                    </tr>
                                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['error'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 67
                echo "                            </tbody>
                            </table>
                        </div>
                    ";
            }
            // line 71
            echo "                </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['file'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 73
        echo "        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "/reports/errors.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  187 => 73,  180 => 71,  174 => 67,  165 => 64,  161 => 63,  157 => 62,  152 => 61,  148 => 60,  133 => 48,  129 => 47,  120 => 44,  118 => 43,  115 => 42,  111 => 41,  108 => 40,  104 => 38,  102 => 37,  91 => 33,  84 => 28,  78 => 27,  75 => 26,  67 => 24,  64 => 23,  59 => 22,  57 => 21,  42 => 8,  39 => 7,  32 => 4,  29 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "/reports/errors.html.twig", "phar:///Applications/MAMP/htdocs/TYPO3/Extensions/cf_google_authenticator/phpDocumentor.phar/src/phpDocumentor/../../data/templates/../templates/responsive-twig//reports/errors.html.twig");
    }
}
