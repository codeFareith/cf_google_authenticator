<?php

/* /index.html.twig */
class __TwigTemplate_7dbef56a10176f1b16b89bc0c536b43f8329302b8b69aaa60c8c8ea0fa0bee9b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout.html.twig", "/index.html.twig", 1);
        $this->blocks = array(
            'heroUnit' => array($this, 'block_heroUnit'),
            'content' => array($this, 'block_content'),
            'listRootNamespaces' => array($this, 'block_listRootNamespaces'),
            'listRootPackages' => array($this, 'block_listRootPackages'),
            'listCharts' => array($this, 'block_listCharts'),
            'listReports' => array($this, 'block_listReports'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 3
        $context["macros"] = $this->loadTemplate("base/macros.html.twig", "/index.html.twig", 3);
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 5
    public function block_heroUnit($context, array $blocks = array())
    {
        // line 6
        echo "    <div class=\"hero-unit\">
        <h1>";
        // line 7
        echo $this->getAttribute(($context["project"] ?? null), "name", array());
        echo "</h1>
        <h2>Documentation</h2>
    </div>
";
    }

    // line 12
    public function block_content($context, array $blocks = array())
    {
        // line 13
        echo "    <div class=\"row\">
        <div class=\"span7\">
            ";
        // line 15
        if (((twig_length_filter($this->env, $this->getAttribute($this->getAttribute(($context["project"] ?? null), "indexes", array()), "namespaces", array())) > 0) ||  !$this->getAttribute($this->getAttribute(($context["project"] ?? null), "indexes", array()), "packages", array()))) {
            // line 16
            echo "                <div class=\"well\">
                    <ul class=\"nav nav-list\">
                        <li class=\"nav-header\">Namespaces</li>
                        ";
            // line 19
            $this->displayBlock('listRootNamespaces', $context, $blocks);
            // line 25
            echo "                    </ul>
                </div>
            ";
        }
        // line 28
        echo "
            ";
        // line 29
        if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute(($context["project"] ?? null), "indexes", array()), "packages", array())) > 0)) {
            // line 30
            echo "                <div class=\"well\">
                    <ul class=\"nav nav-list\">
                        <li class=\"nav-header\">Packages</li>
                        ";
            // line 33
            $this->displayBlock('listRootPackages', $context, $blocks);
            // line 39
            echo "                    </ul>
                </div>
            ";
        }
        // line 42
        echo "
        </div>
        <div class=\"span5\">
            <div class=\"well\">
                <ul class=\"nav nav-list\">
                    <li class=\"nav-header\">Charts</li>
                    ";
        // line 48
        $this->displayBlock('listCharts', $context, $blocks);
        // line 51
        echo "                </ul>
            </div>
            <div class=\"well\">
                <ul class=\"nav nav-list\">
                    <li class=\"nav-header\">Reports</li>
                    ";
        // line 56
        $this->displayBlock('listReports', $context, $blocks);
        // line 73
        echo "                </ul>
            </div>
        </div>
    </div>
";
    }

    // line 19
    public function block_listRootNamespaces($context, array $blocks = array())
    {
        // line 20
        echo "                            <li><a href=\"";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array($this->getAttribute(($context["project"] ?? null), "namespace", array()))), "html", null, true);
        echo "\">Global (";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["project"] ?? null), "namespace", array()), "name", array()), "html", null, true);
        echo ")</a></li>
                            ";
        // line 21
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(call_user_func_array($this->env->getFilter('sort_asc')->getCallable(), array("asc", $this->getAttribute($this->getAttribute(($context["project"] ?? null), "namespace", array()), "children", array()))));
        foreach ($context['_seq'] as $context["_key"] => $context["namespace"]) {
            // line 22
            echo "                                <li><a href=\"";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array($context["namespace"])), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["namespace"], "name", array()), "html", null, true);
            echo "</a></li>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['namespace'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 24
        echo "                        ";
    }

    // line 33
    public function block_listRootPackages($context, array $blocks = array())
    {
        // line 34
        echo "                            <li><a href=\"";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array(twig_first($this->env, $this->getAttribute($this->getAttribute(($context["project"] ?? null), "indexes", array()), "packages", array())))), "html", null, true);
        echo "\">Global (";
        echo twig_escape_filter($this->env, $this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute(($context["project"] ?? null), "indexes", array()), "packages", array())), "name", array()), "html", null, true);
        echo ")</a></li>
                            ";
        // line 35
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(call_user_func_array($this->env->getFilter('sort_asc')->getCallable(), array("asc", $this->getAttribute(twig_first($this->env, $this->getAttribute($this->getAttribute(($context["project"] ?? null), "indexes", array()), "packages", array())), "children", array()))));
        foreach ($context['_seq'] as $context["_key"] => $context["package"]) {
            // line 36
            echo "                                <li><a href=\"";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array($context["package"])), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["package"], "name", array()), "html", null, true);
            echo "</a></li>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['package'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 38
        echo "                        ";
    }

    // line 48
    public function block_listCharts($context, array $blocks = array())
    {
        // line 49
        echo "                        <li><a href=\"";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array("graph_class.html")), "html", null, true);
        echo "\"><i class=\"icon-list-alt\"></i> Class inheritance diagram</a></li>
                    ";
    }

    // line 56
    public function block_listReports($context, array $blocks = array())
    {
        // line 57
        echo "                        <li>
                            <a href=\"";
        // line 58
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array("errors.html")), "html", null, true);
        echo "\">
                                <i class=\"icon-list-alt\"></i> Errors ";
        // line 59
        echo $context["macros"]->getrenderErrorCounter($this->getAttribute(($context["project"] ?? null), "files", array()));
        echo "
                            </a>
                        </li>
                        <li>
                            <a href=\"";
        // line 63
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array("deprecated.html")), "html", null, true);
        echo "\">
                                <i class=\"icon-list-alt\"></i> Deprecated ";
        // line 64
        echo $context["macros"]->getrenderDeprecatedCounter($this->getAttribute($this->getAttribute(($context["project"] ?? null), "indexes", array()), "elements", array()));
        echo "
                            </a>
                        </li>
                        <li>
                            <a href=\"";
        // line 68
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array("markers.html")), "html", null, true);
        echo "\">
                                <i class=\"icon-list-alt\"></i> Markers ";
        // line 69
        echo $context["macros"]->getrenderMarkerCounter($this->getAttribute(($context["project"] ?? null), "files", array()));
        echo "
                            </a>
                        </li>
                    ";
    }

    public function getTemplateName()
    {
        return "/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  215 => 69,  211 => 68,  204 => 64,  200 => 63,  193 => 59,  189 => 58,  186 => 57,  183 => 56,  176 => 49,  173 => 48,  169 => 38,  158 => 36,  154 => 35,  147 => 34,  144 => 33,  140 => 24,  129 => 22,  125 => 21,  118 => 20,  115 => 19,  107 => 73,  105 => 56,  98 => 51,  96 => 48,  88 => 42,  83 => 39,  81 => 33,  76 => 30,  74 => 29,  71 => 28,  66 => 25,  64 => 19,  59 => 16,  57 => 15,  53 => 13,  50 => 12,  42 => 7,  39 => 6,  36 => 5,  32 => 1,  30 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "/index.html.twig", "phar:///Applications/MAMP/htdocs/TYPO3/Extensions/cf_google_authenticator/phpDocumentor.phar/src/phpDocumentor/../../data/templates/../templates/responsive-twig//index.html.twig");
    }
}
