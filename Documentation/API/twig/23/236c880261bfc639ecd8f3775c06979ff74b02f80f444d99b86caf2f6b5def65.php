<?php

/* /package.html.twig */
class __TwigTemplate_1fc23004c0bde29680c5911bdca5038b0b1577bfff19d9711c666b75f4a97e17 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout.html.twig", "/package.html.twig", 1);
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

    // line 90
    public function block_title($context, array $blocks = array())
    {
        // line 91
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["project"] ?? null), "title", array()), "html", null, true);
        echo " &raquo; ";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["node"] ?? null), "FullyQualifiedStructuralElementName", array()), "html", null, true);
        echo "
";
    }

    // line 94
    public function block_content($context, array $blocks = array())
    {
        // line 95
        echo "    ";
        $context["self"] = $this;
        // line 96
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
                    <i class=\"icon-map-marker\"></i> Packages
                </li>
                <a href=\"";
        // line 110
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array(($context["node"] ?? null))), "html", null, true);
        echo "\" title=\"";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["node"] ?? null), "name", array()), "html", null, true);
        echo "\">
                    <i class=\"icon-th\"></i> ";
        // line 111
        echo twig_escape_filter($this->env, $this->getAttribute(($context["node"] ?? null), "name", array()), "html", null, true);
        echo "
                </a>
                <ul class=\"nav nav-list nav-packages\">
                    ";
        // line 114
        echo $context["self"]->getrenderPackageSidebar(($context["node"] ?? null));
        echo "
                </ul>
            </ul>
        </div>

        <div class=\"span8 package-contents\">
            ";
        // line 120
        echo $context["self"]->getrenderPackageDetails(($context["node"] ?? null));
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
            echo twig_escape_filter($this->env, $this->getAttribute(($context["element"] ?? null), "name", array()), "html", null, true);
            echo "\" class=\"element ajax clickable ";
            echo twig_escape_filter($this->env, ($context["type"] ?? null), "html", null, true);
            echo "\">
        <h1>";
            // line 5
            echo twig_escape_filter($this->env, $this->getAttribute(($context["element"] ?? null), "name", array()), "html", null, true);
            echo "<a href=\"";
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array(($context["element"] ?? null))), "html", null, true);
            echo "\">¶</a></h1>
        <p class=\"short_description\">";
            // line 6
            echo twig_escape_filter($this->env, $this->getAttribute(($context["element"] ?? null), "summary", array()), "html", null, true);
            echo "</p>
        <div class=\"details collapse\">";
            // line 7
            echo twig_escape_filter($this->env, $this->getAttribute(($context["element"] ?? null), "description", array()), "html", null, true);
            echo "</div>
        <a href=\"";
            // line 8
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array(($context["element"] ?? null))), "html", null, true);
            echo "\" class=\"more\">« More »</a>
    </div>
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

    // line 12
    public function getbuildBreadcrumb($__element__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "element" => $__element__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 13
            echo "    ";
            $context["self"] = $this;
            // line 14
            echo "
    ";
            // line 15
            if (($this->getAttribute(($context["element"] ?? null), "parent", array()) && ($this->getAttribute($this->getAttribute(($context["element"] ?? null), "parent", array()), "name", array()) != "\\"))) {
                // line 16
                echo "        ";
                echo $context["self"]->getbuildBreadcrumb($this->getAttribute(($context["element"] ?? null), "parent", array()));
                echo "
    ";
            }
            // line 18
            echo "
    <li>
        <span class=\"divider\">\\</span><a href=\"";
            // line 20
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

    // line 24
    public function getrenderPackageDetails($__node__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "node" => $__node__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 25
            echo "    ";
            $context["self"] = $this;
            // line 26
            echo "
    <ul class=\"breadcrumb\">
        <li><a href=\"";
            // line 28
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array("index.html")), "html", null, true);
            echo "\"><i class=\"icon-th\"></i></a></li>
        ";
            // line 29
            echo $context["self"]->getbuildBreadcrumb(($context["node"] ?? null));
            echo "
    </ul>

    ";
            // line 32
            if ((((((twig_length_filter($this->env, $this->getAttribute(($context["node"] ?? null), "classes", array())) > 0) || (twig_length_filter($this->env, $this->getAttribute(($context["node"] ?? null), "interfaces", array())) > 0)) || (twig_length_filter($this->env, $this->getAttribute(($context["node"] ?? null), "traits", array())) > 0)) || (twig_length_filter($this->env, $this->getAttribute(($context["node"] ?? null), "functions", array())) > 0)) || (twig_length_filter($this->env, $this->getAttribute(($context["node"] ?? null), "constants", array())) > 0))) {
                // line 33
                echo "
        ";
                // line 34
                if ((twig_length_filter($this->env, $this->getAttribute(($context["node"] ?? null), "functions", array())) > 0)) {
                    // line 35
                    echo "            <div class=\"package-indent\">
                <h3><i class=\"icon-custom icon-function\"></i> Functions</h3>
                ";
                    // line 37
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["node"] ?? null), "functions", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["function"]) {
                        // line 38
                        echo "                    ";
                        echo $context["self"]->getelementSummary($context["function"], "function");
                        echo "
                ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['function'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 40
                    echo "            </div>
        ";
                }
                // line 42
                echo "
        ";
                // line 43
                if ((twig_length_filter($this->env, $this->getAttribute(($context["node"] ?? null), "constants", array())) > 0)) {
                    // line 44
                    echo "            <div class=\"package-indent\">
                <h3><i class=\"icon-custom icon-constant\"></i> Constants</h3>
                ";
                    // line 46
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["node"] ?? null), "constants", array()));
                    foreach ($context['_seq'] as $context["_key"] => $context["constant"]) {
                        // line 47
                        echo "                    ";
                        echo $context["self"]->getelementSummary($context["constant"], "constant");
                        echo "
                ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['constant'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 49
                    echo "            </div>
        ";
                }
                // line 51
                echo "
        ";
                // line 52
                if ((((twig_length_filter($this->env, $this->getAttribute(($context["node"] ?? null), "classes", array())) > 0) || (twig_length_filter($this->env, $this->getAttribute(($context["node"] ?? null), "interfaces", array())) > 0)) || (twig_length_filter($this->env, $this->getAttribute(($context["node"] ?? null), "traits", array())) > 0))) {
                    // line 53
                    echo "            <div class=\"package-indent\">
                <h3><i class=\"icon-custom icon-class\"></i> Classes, interfaces and traits</h3>
                ";
                    // line 55
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(call_user_func_array($this->env->getFilter('sort_asc')->getCallable(), array("asc", $this->getAttribute(($context["node"] ?? null), "traits", array()))));
                    foreach ($context['_seq'] as $context["_key"] => $context["trait"]) {
                        // line 56
                        echo "                    ";
                        echo $context["self"]->getelementSummary($context["trait"], "trait");
                        echo "
                ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['trait'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 58
                    echo "
                ";
                    // line 59
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(call_user_func_array($this->env->getFilter('sort_asc')->getCallable(), array("asc", $this->getAttribute(($context["node"] ?? null), "interfaces", array()))));
                    foreach ($context['_seq'] as $context["_key"] => $context["interface"]) {
                        // line 60
                        echo "                    ";
                        echo $context["self"]->getelementSummary($context["interface"], "interface");
                        echo "
                ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['interface'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 62
                    echo "
                ";
                    // line 63
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(call_user_func_array($this->env->getFilter('sort_asc')->getCallable(), array("asc", $this->getAttribute(($context["node"] ?? null), "classes", array()))));
                    foreach ($context['_seq'] as $context["_key"] => $context["class"]) {
                        // line 64
                        echo "                    ";
                        echo $context["self"]->getelementSummary($context["class"], "class");
                        echo "
                ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['class'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 66
                    echo "            </div>
        ";
                }
                // line 68
                echo "    ";
            }
            // line 69
            echo "
    ";
            // line 70
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["node"] ?? null), "children", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["package"]) {
                // line 71
                echo "        ";
                echo $context["self"]->getrenderPackageDetails($context["package"]);
                echo "
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['package'], $context['_parent'], $context['loop']);
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

    // line 75
    public function getrenderPackageSidebar($__node__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "node" => $__node__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 76
            echo "    ";
            $context["self"] = $this;
            // line 77
            echo "
    ";
            // line 78
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(call_user_func_array($this->env->getFilter('sort_asc')->getCallable(), array("asc", $this->getAttribute(($context["node"] ?? null), "children", array()))));
            foreach ($context['_seq'] as $context["_key"] => $context["package"]) {
                // line 79
                echo "    <li>
        <a href=\"";
                // line 80
                echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array($context["package"])), "html", null, true);
                echo "\" title=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["package"], "name", array()), "html", null, true);
                echo "\">
            <i class=\"icon-th\"></i> ";
                // line 81
                echo twig_escape_filter($this->env, $this->getAttribute($context["package"], "name", array()), "html", null, true);
                echo "
        </a>
        <ul class=\"nav nav-list nav-packages\">
            ";
                // line 84
                echo $context["self"]->getrenderPackageSidebar($context["package"]);
                echo "
        </ul>
    </li>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['package'], $context['_parent'], $context['loop']);
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
        return "/package.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  404 => 84,  398 => 81,  392 => 80,  389 => 79,  385 => 78,  382 => 77,  379 => 76,  367 => 75,  345 => 71,  341 => 70,  338 => 69,  335 => 68,  331 => 66,  322 => 64,  318 => 63,  315 => 62,  306 => 60,  302 => 59,  299 => 58,  290 => 56,  286 => 55,  282 => 53,  280 => 52,  277 => 51,  273 => 49,  264 => 47,  260 => 46,  256 => 44,  254 => 43,  251 => 42,  247 => 40,  238 => 38,  234 => 37,  230 => 35,  228 => 34,  225 => 33,  223 => 32,  217 => 29,  213 => 28,  209 => 26,  206 => 25,  194 => 24,  174 => 20,  170 => 18,  164 => 16,  162 => 15,  159 => 14,  156 => 13,  144 => 12,  126 => 8,  122 => 7,  118 => 6,  112 => 5,  105 => 4,  92 => 3,  84 => 120,  75 => 114,  69 => 111,  63 => 110,  47 => 96,  44 => 95,  41 => 94,  32 => 91,  29 => 90,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "/package.html.twig", "phar:///Applications/MAMP/htdocs/TYPO3/Extensions/cf_google_authenticator/phpDocumentor.phar/src/phpDocumentor/../../data/templates/../templates/responsive-twig//package.html.twig");
    }
}
