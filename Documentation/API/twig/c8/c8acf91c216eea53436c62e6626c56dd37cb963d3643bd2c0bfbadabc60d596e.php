<?php

/* /namespace.html.twig */
class __TwigTemplate_73486267fe86ff0093a9b0d6363d630f121ab858bfd111e42cda7db0ba22ff93 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout.html.twig", "/namespace.html.twig", 1);
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

    // line 96
    public function block_title($context, array $blocks = array())
    {
        // line 97
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["project"] ?? null), "title", array()), "html", null, true);
        echo " &raquo; ";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["node"] ?? null), "FullyQualifiedStructuralElementName", array()), "html", null, true);
        echo "
";
    }

    // line 100
    public function block_content($context, array $blocks = array())
    {
        // line 101
        echo "    ";
        $context["self"] = $this;
        // line 102
        echo "
    <div class=\"row\">

        <div class=\"span4\">
            <div class=\"btn-group view pull-right\" data-toggle=\"buttons-radio\">
                <button class=\"btn details\" title=\"Show descriptions and method names\">
                    <i class=\"icon-list\"></i></button><button class=\"btn simple\" title=\"Show only method names\">
                    <i class=\"icon-align-justify\"></i>
                </button>
            </div>
            <ul class=\"side-nav nav nav-list\">
                <li class=\"nav-header\">
                    <i class=\"icon-map-marker\"></i> Namespaces
                </li>
                <a href=\"";
        // line 116
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array(($context["node"] ?? null))), "html", null, true);
        echo "\" title=\"";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["node"] ?? null), "name", array()), "html", null, true);
        echo "\">
                    <i class=\"icon-th\"></i> ";
        // line 117
        echo twig_escape_filter($this->env, $this->getAttribute(($context["node"] ?? null), "name", array()), "html", null, true);
        echo "
                </a>
                <ul class=\"nav nav-list nav-namespaces\">
                    ";
        // line 120
        echo $context["self"]->getrenderNamespaceSidebar(($context["node"] ?? null));
        echo "
                </ul>
            </ul>
        </div>

        <div class=\"span8 namespace-contents\">
            ";
        // line 126
        echo $context["self"]->getrenderNamespaceDetails(($context["node"] ?? null));
        echo "
        </div>
    </div>
";
    }

    // line 3
    public function getelementSummary($__element__ = null, $__type__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "element" => $__element__,
            "type" => $__type__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 4
            echo "    <div id=\"";
            echo twig_escape_filter($this->env, ($context["type"] ?? null), "html", null, true);
            echo "_";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["element"] ?? null), "name", array()), "html", null, true);
            echo "\" class=\"element ajax clickable ";
            echo twig_escape_filter($this->env, ($context["type"] ?? null), "html", null, true);
            echo "\" data-toggle=\"collapse\" data-target=\"#";
            echo twig_escape_filter($this->env, ($context["type"] ?? null), "html", null, true);
            echo "_";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["element"] ?? null), "name", array()), "html", null, true);
            echo " .collapse\">
        <h1>";
            // line 5
            echo twig_escape_filter($this->env, $this->getAttribute(($context["element"] ?? null), "name", array()), "html", null, true);
            if (call_user_func_array($this->env->getFunction('path')->getCallable(), array(($context["element"] ?? null)))) {
                echo "<a href=\"";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array(($context["element"] ?? null))), "html", null, true);
                echo "\">¶</a>";
            }
            echo "</h1>
        <p class=\"short_description\">";
            // line 6
            echo twig_escape_filter($this->env, $this->getAttribute(($context["element"] ?? null), "summary", array()), "html", null, true);
            echo "</p>
        <div class=\"details collapse\">
            ";
            // line 8
            if ((($context["type"] ?? null) == "function")) {
                // line 9
                echo "                ";
                $this->loadTemplate("method.html.twig", "/namespace.html.twig", 9)->display(array_merge($context, array("method" => ($context["element"] ?? null))));
                // line 10
                echo "            ";
            } else {
                // line 11
                echo "                ";
                echo call_user_func_array($this->env->getFilter('markdown')->getCallable(), array($this->getAttribute(($context["element"] ?? null), "description", array())));
                echo "
            ";
            }
            // line 13
            echo "        </div>
        ";
            // line 14
            if (call_user_func_array($this->env->getFunction('path')->getCallable(), array(($context["element"] ?? null)))) {
                echo "<a href=\"";
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array(($context["element"] ?? null))), "html", null, true);
                echo "\" class=\"more\">« More »</a>";
            }
            // line 15
            echo "    </div>
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 18
    public function getbuildBreadcrumb($__element__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "element" => $__element__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 19
            echo "    ";
            $context["self"] = $this;
            // line 20
            echo "
    ";
            // line 21
            if (($this->getAttribute(($context["element"] ?? null), "parent", array()) && ($this->getAttribute($this->getAttribute(($context["element"] ?? null), "parent", array()), "name", array()) != "\\"))) {
                // line 22
                echo "        ";
                echo $context["self"]->getbuildBreadcrumb($this->getAttribute(($context["element"] ?? null), "parent", array()));
                echo "
    ";
            }
            // line 24
            echo "
    <li>
        <span class=\"divider\">\\</span><a href=\"";
            // line 26
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array(($context["element"] ?? null))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["element"] ?? null), "name", array()), "html", null, true);
            echo "</a>
    </li>
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 30
    public function getrenderNamespaceDetails($__node__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "node" => $__node__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 31
            echo "    ";
            $context["self"] = $this;
            // line 32
            echo "
    ";
            // line 33
            if ((((((twig_length_filter($this->env, $this->getAttribute(($context["node"] ?? null), "classes", array())) > 0) || (twig_length_filter($this->env, $this->getAttribute(($context["node"] ?? null), "interfaces", array())) > 0)) || (twig_length_filter($this->env, $this->getAttribute(($context["node"] ?? null), "traits", array())) > 0)) || (twig_length_filter($this->env, $this->getAttribute(($context["node"] ?? null), "functions", array())) > 0)) || (twig_length_filter($this->env, $this->getAttribute(($context["node"] ?? null), "constants", array())) > 0))) {
                // line 34
                echo "
        <ul class=\"breadcrumb\">
            <li><a href=\"";
                // line 36
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array("index.html")), "html", null, true);
                echo "\"><i class=\"icon-th\"></i></a></li>
            ";
                // line 37
                echo $context["self"]->getbuildBreadcrumb(($context["node"] ?? null));
                echo "
        </ul>

        ";
                // line 40
                if ((twig_length_filter($this->env, $this->getAttribute(($context["node"] ?? null), "functions", array())) > 0)) {
                    // line 41
                    echo "            <div class=\"namespace-indent\">
                <h3><i class=\"icon-custom icon-function\"></i> Functions</h3>
                ";
                    // line 43
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(call_user_func_array($this->env->getFilter('sort_asc')->getCallable(), array("asc", $this->getAttribute(($context["node"] ?? null), "functions", array()))));
                    foreach ($context['_seq'] as $context["_key"] => $context["function"]) {
                        // line 44
                        echo "                    ";
                        echo $context["self"]->getelementSummary($context["function"], "function");
                        echo "
                ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['function'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 46
                    echo "            </div>
        ";
                }
                // line 48
                echo "
        ";
                // line 49
                if ((twig_length_filter($this->env, $this->getAttribute(($context["node"] ?? null), "constants", array())) > 0)) {
                    // line 50
                    echo "            <div class=\"namespace-indent\">
                <h3><i class=\"icon-custom icon-constant\"></i> Constants</h3>
                ";
                    // line 52
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["node"] ?? null), "constants", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["constant"]) {
                        // line 53
                        echo "                    ";
                        echo $context["self"]->getelementSummary($context["constant"], "constant");
                        echo "
                ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['constant'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 55
                    echo "            </div>
        ";
                }
                // line 57
                echo "
        ";
                // line 58
                if ((((twig_length_filter($this->env, $this->getAttribute(($context["node"] ?? null), "classes", array())) > 0) || (twig_length_filter($this->env, $this->getAttribute(($context["node"] ?? null), "interfaces", array())) > 0)) || (twig_length_filter($this->env, $this->getAttribute(($context["node"] ?? null), "traits", array())) > 0))) {
                    // line 59
                    echo "            <div class=\"namespace-indent\">
                <h3><i class=\"icon-custom icon-class\"></i> Classes, interfaces and traits</h3>
                ";
                    // line 61
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(call_user_func_array($this->env->getFilter('sort_asc')->getCallable(), array("asc", $this->getAttribute(($context["node"] ?? null), "traits", array()))));
                    foreach ($context['_seq'] as $context["_key"] => $context["trait"]) {
                        // line 62
                        echo "                    ";
                        echo $context["self"]->getelementSummary($context["trait"], "trait");
                        echo "
                ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['trait'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 64
                    echo "
                ";
                    // line 65
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(call_user_func_array($this->env->getFilter('sort_asc')->getCallable(), array("asc", $this->getAttribute(($context["node"] ?? null), "interfaces", array()))));
                    foreach ($context['_seq'] as $context["_key"] => $context["interface"]) {
                        // line 66
                        echo "                    ";
                        echo $context["self"]->getelementSummary($context["interface"], "interface");
                        echo "
                ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['interface'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 68
                    echo "
                ";
                    // line 69
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(call_user_func_array($this->env->getFilter('sort_asc')->getCallable(), array("asc", $this->getAttribute(($context["node"] ?? null), "classes", array()))));
                    foreach ($context['_seq'] as $context["_key"] => $context["class"]) {
                        // line 70
                        echo "                    ";
                        echo $context["self"]->getelementSummary($context["class"], "class");
                        echo "
                ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['class'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 72
                    echo "            </div>
        ";
                }
                // line 74
                echo "    ";
            }
            // line 75
            echo "
    ";
            // line 76
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["node"] ?? null), "children", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["namespace"]) {
                // line 77
                echo "        ";
                echo $context["self"]->getrenderNamespaceDetails($context["namespace"]);
                echo "
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['namespace'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    // line 81
    public function getrenderNamespaceSidebar($__node__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "node" => $__node__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 82
            echo "    ";
            $context["self"] = $this;
            // line 83
            echo "
    ";
            // line 84
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(call_user_func_array($this->env->getFilter('sort_asc')->getCallable(), array("asc", $this->getAttribute(($context["node"] ?? null), "children", array()))));
            foreach ($context['_seq'] as $context["_key"] => $context["namespace"]) {
                // line 85
                echo "    <li>
        <a href=\"";
                // line 86
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array($context["namespace"])), "html", null, true);
                echo "\" title=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["namespace"], "name", array()), "html", null, true);
                echo "\">
            <i class=\"icon-th\"></i> ";
                // line 87
                echo twig_escape_filter($this->env, $this->getAttribute($context["namespace"], "name", array()), "html", null, true);
                echo "
        </a>
        <ul class=\"nav nav-list nav-namespaces\">
            ";
                // line 90
                echo $context["self"]->getrenderNamespaceSidebar($context["namespace"]);
                echo "
        </ul>
    </li>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['namespace'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "/namespace.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  431 => 90,  425 => 87,  419 => 86,  416 => 85,  412 => 84,  409 => 83,  406 => 82,  394 => 81,  372 => 77,  368 => 76,  365 => 75,  362 => 74,  358 => 72,  349 => 70,  345 => 69,  342 => 68,  333 => 66,  329 => 65,  326 => 64,  317 => 62,  313 => 61,  309 => 59,  307 => 58,  304 => 57,  300 => 55,  291 => 53,  287 => 52,  283 => 50,  281 => 49,  278 => 48,  274 => 46,  265 => 44,  261 => 43,  257 => 41,  255 => 40,  249 => 37,  245 => 36,  241 => 34,  239 => 33,  236 => 32,  233 => 31,  221 => 30,  201 => 26,  197 => 24,  191 => 22,  189 => 21,  186 => 20,  183 => 19,  171 => 18,  155 => 15,  149 => 14,  146 => 13,  140 => 11,  137 => 10,  134 => 9,  132 => 8,  127 => 6,  118 => 5,  105 => 4,  92 => 3,  84 => 126,  75 => 120,  69 => 117,  63 => 116,  47 => 102,  44 => 101,  41 => 100,  32 => 97,  29 => 96,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "/namespace.html.twig", "phar:///Applications/MAMP/htdocs/TYPO3/Extensions/cf_google_authenticator/phpDocumentor.phar/src/phpDocumentor/../../data/templates/../templates/responsive-twig//namespace.html.twig");
    }
}
