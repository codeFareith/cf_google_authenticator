<?php

/* /class.html.twig */
class __TwigTemplate_76586a78bbf917277020d48693e849ab7c0d2b696616eaa76c09395daf377c4f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout.html.twig", "/class.html.twig", 1);
        $_trait_0 = $this->loadTemplate("base/class.sidebar.html.twig", "/class.html.twig", 4);
        // line 4
        if (!$_trait_0->isTraitable()) {
            throw new Twig_Error_Runtime('Template "'."base/class.sidebar.html.twig".'" cannot be used as a trait.');
        }
        $_trait_0_blocks = $_trait_0->getBlocks();

        $this->traits = $_trait_0_blocks;

        $this->blocks = array_merge(
            $this->traits,
            array(
                'title' => array($this, 'block_title'),
                'content' => array($this, 'block_content'),
            )
        );
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 3
        $context["macros"] = $this->loadTemplate("base/macros.html.twig", "/class.html.twig", 3);
        // line 1
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 6
    public function block_title($context, array $blocks = array())
    {
        // line 7
        echo "    ";
        $this->displayParentBlock("title", $context, $blocks);
        echo " &raquo; ";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["node"] ?? null), "FullyQualifiedStructuralElementName", array()), "html", null, true);
        echo "
";
    }

    // line 10
    public function block_content($context, array $blocks = array())
    {
        // line 11
        echo "    <style>
        .deprecated h2 {
            text-decoration: line-through;
        }
    </style>
    <div class=\"row\">
        <div class=\"span4\">
            ";
        // line 18
        $this->displayBlock("sidebar", $context, $blocks);
        echo "
        </div>

        <div class=\"span8\">
            <div class=\"element class\">
                <h1>";
        // line 23
        echo twig_escape_filter($this->env, $this->getAttribute(($context["node"] ?? null), "name", array()), "html", null, true);
        echo "</h1>
                <small style=\"display: block; text-align: right\">
                    ";
        // line 25
        if ($this->getAttribute(($context["node"] ?? null), "parent", array())) {
            // line 26
            echo "                        Extends ";
            echo twig_join_filter(call_user_func_array($this->env->getFilter('route')->getCallable(), array($this->getAttribute(($context["node"] ?? null), "parent", array()))), ", ");
            echo "
                    ";
        }
        // line 28
        echo "                    ";
        if (twig_length_filter($this->env, $this->getAttribute(($context["node"] ?? null), "interfaces", array()))) {
            // line 29
            echo "                        Implements ";
            echo twig_join_filter(call_user_func_array($this->env->getFilter('route')->getCallable(), array($this->getAttribute(($context["node"] ?? null), "interfaces", array()))), ", ");
            echo "
                    ";
        }
        // line 31
        echo "                </small>
                <p class=\"short_description\">";
        // line 32
        echo twig_escape_filter($this->env, $this->getAttribute(($context["node"] ?? null), "summary", array()), "html", null, true);
        echo "</p>
                <div class=\"details\">
                    <div class=\"long_description\">
                        ";
        // line 35
        echo call_user_func_array($this->env->getFilter('markdown')->getCallable(), array($this->getAttribute(($context["node"] ?? null), "description", array())));
        echo "
                    </div>
                    <table class=\"table table-bordered\">
                        ";
        // line 38
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["node"] ?? null), "tags", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["tagList"]) {
            // line 39
            echo "                            ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($context["tagList"]);
            foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                if (!twig_in_filter($this->getAttribute($context["tag"], "name", array()), array(0 => "method", 1 => "property"))) {
                    // line 40
                    echo "                                <tr>
                                    <th>
                                        ";
                    // line 42
                    echo twig_escape_filter($this->env, $this->getAttribute($context["tag"], "name", array()), "html", null, true);
                    echo "
                                        ";
                    // line 43
                    if ($this->getAttribute($context["tag"], "type", array())) {
                        // line 44
                        echo "                                            ";
                        echo twig_join_filter(call_user_func_array($this->env->getFilter('route')->getCallable(), array($this->getAttribute($context["tag"], "type", array()))), "|");
                        echo "
                                        ";
                    }
                    // line 46
                    echo "                                    </th>
                                    <td>
                                        ";
                    // line 48
                    if ((($this->getAttribute($context["tag"], "name", array()) == "since") || "deprecated")) {
                        // line 49
                        echo "                                            ";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["tag"], "version", array()), "html", null, true);
                        echo "
                                        ";
                    }
                    // line 51
                    echo "                                        ";
                    echo call_user_func_array($this->env->getFilter('markdown')->getCallable(), array($this->getAttribute($context["tag"], "description", array())));
                    echo "
                                    </td>
                                </tr>
                            ";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 55
            echo "                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tagList'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 56
        echo "                    </table>

                    <h3><i class=\"icon-custom icon-method\"></i> Methods</h3>
                    ";
        // line 59
        $context["specialMethods"] = (($this->getAttribute(($context["node"] ?? null), "magicMethods", array())) ? ($this->getAttribute($this->getAttribute(($context["node"] ?? null), "inheritedMethods", array()), "merge", array(0 => $this->getAttribute(($context["node"] ?? null), "magicMethods", array())), "method")) : ($this->getAttribute(($context["node"] ?? null), "inheritedMethods", array())));
        // line 60
        echo "                    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(call_user_func_array($this->env->getFilter('sort_asc')->getCallable(), array("asc", $this->getAttribute($this->getAttribute(($context["node"] ?? null), "methods", array()), "merge", array(0 => ($context["specialMethods"] ?? null)), "method"))));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["method"]) {
            // line 61
            echo "                        <a id=\"method_";
            echo twig_escape_filter($this->env, $this->getAttribute($context["method"], "name", array()), "html", null, true);
            echo "\"></a>
                        <div class=\"element clickable method ";
            // line 62
            echo twig_escape_filter($this->env, $this->getAttribute($context["method"], "visibility", array()), "html", null, true);
            echo " ";
            echo (($this->getAttribute($context["method"], "deprecated", array())) ? ("deprecated") : (""));
            echo " method_";
            echo twig_escape_filter($this->env, $this->getAttribute($context["method"], "name", array()), "html", null, true);
            echo ((($this->getAttribute($this->getAttribute($context["method"], "parent", array()), "name", array()) != $this->getAttribute(($context["node"] ?? null), "name", array()))) ? (" inherited") : (""));
            echo "\" data-toggle=\"collapse\" data-target=\".method_";
            echo twig_escape_filter($this->env, $this->getAttribute($context["method"], "name", array()), "html", null, true);
            echo " .collapse\">
                            <h2>";
            // line 63
            echo twig_escape_filter($this->env, (($this->getAttribute($context["method"], "summary", array())) ? ($this->getAttribute($context["method"], "summary", array())) : ($this->getAttribute($context["method"], "name", array()))), "html", null, true);
            echo "</h2>
                            <pre>";
            // line 64
            echo twig_escape_filter($this->env, $this->getAttribute($context["method"], "name", array()), "html", null, true);
            echo "(";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["method"], "arguments", array()));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["argument"]) {
                echo twig_escape_filter($this->env, (($this->getAttribute($context["argument"], "types", array())) ? ((twig_join_filter($this->getAttribute($context["argument"], "types", array()), "|") . " ")) : ("")), "html", null, true);
                echo (($this->getAttribute($context["argument"], "byReference", array())) ? ("&") : (""));
                echo twig_escape_filter($this->env, $this->getAttribute($context["argument"], "name", array()), "html", null, true);
                echo twig_escape_filter($this->env, (( !(null === $this->getAttribute($context["argument"], "default", array()))) ? ((" = " . $this->getAttribute($context["argument"], "default", array()))) : ("")), "html", null, true);
                if ( !$this->getAttribute($context["loop"], "last", array())) {
                    echo ", ";
                }
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['argument'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            echo ") ";
            echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute($context["method"], "response", array()), "types", array())) ? ((": " . twig_join_filter($this->getAttribute($this->getAttribute($context["method"], "response", array()), "types", array()), "|"))) : ("")), "html", null, true);
            echo "</pre>
                            <div class=\"labels\">
                                ";
            // line 66
            if (($this->getAttribute($this->getAttribute($context["method"], "parent", array()), "name", array()) != $this->getAttribute(($context["node"] ?? null), "name", array()))) {
                echo "<span class=\"label\">inherited</span>";
            }
            // line 67
            echo "                                ";
            if ($this->getAttribute($context["method"], "static", array())) {
                echo "<span class=\"label\">static</span>";
            }
            // line 68
            echo "                                ";
            if ($this->getAttribute($context["method"], "final", array())) {
                echo "<span class=\"label\">final</span>";
            }
            // line 69
            echo "                                ";
            if ($this->getAttribute($context["method"], "abstract", array())) {
                echo "<span class=\"label\">abstract</span>";
            }
            // line 70
            echo "                                ";
            if ($this->getAttribute($this->getAttribute($context["method"], "tags", array(), "any", false, true), "api", array(), "any", true, true)) {
                echo "<span class=\"label label-info\">api</span>";
            }
            // line 71
            echo "                            </div>

                            ";
            // line 73
            $this->loadTemplate("method.html.twig", "/class.html.twig", 73)->display(array_merge($context, array("method" => $context["method"])));
            // line 74
            echo "
                        </div>
                    ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['method'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 77
        echo "
                    ";
        // line 78
        if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute(($context["node"] ?? null), "constants", array()), "merge", array(0 => $this->getAttribute(($context["node"] ?? null), "inheritedConstants", array())), "method")) > 0)) {
            // line 79
            echo "                        <h3><i class=\"icon-custom icon-constant\"></i> Constants</h3>
                        ";
            // line 80
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute(($context["node"] ?? null), "constants", array()), "merge", array(0 => $this->getAttribute(($context["node"] ?? null), "inheritedConstants", array())), "method"));
            foreach ($context['_seq'] as $context["_key"] => $context["constant"]) {
                // line 81
                echo "                            <a id=\"constant_";
                echo twig_escape_filter($this->env, $this->getAttribute($context["constant"], "name", array()), "html", null, true);
                echo "\"> </a>
                            <div class=\"element clickable constant ";
                // line 82
                echo (($this->getAttribute($context["constant"], "deprecated", array())) ? ("deprecated") : (""));
                echo " constant_";
                echo twig_escape_filter($this->env, $this->getAttribute($context["constant"], "name", array()), "html", null, true);
                echo ((($this->getAttribute($this->getAttribute($context["constant"], "parent", array()), "name", array()) != $this->getAttribute(($context["node"] ?? null), "name", array()))) ? (" inherited") : (""));
                echo "\" data-toggle=\"collapse\" data-target=\".constant_";
                echo twig_escape_filter($this->env, $this->getAttribute($context["constant"], "name", array()), "html", null, true);
                echo " .collapse\">
                                <h2>";
                // line 83
                echo twig_escape_filter($this->env, (($this->getAttribute($context["constant"], "summary", array())) ? ($this->getAttribute($context["constant"], "summary", array())) : ($this->getAttribute($context["constant"], "name", array()))), "html", null, true);
                echo "</h2>
                                <pre>";
                // line 84
                echo twig_escape_filter($this->env, $this->getAttribute($context["constant"], "name", array()), "html", null, true);
                echo "</pre>
                                <div class=\"labels\">
                                    ";
                // line 86
                if (($this->getAttribute($this->getAttribute($context["constant"], "parent", array()), "name", array()) != $this->getAttribute(($context["node"] ?? null), "name", array()))) {
                    echo "<span class=\"label\">inherited</span>";
                }
                // line 87
                echo "                                </div>
                                <div class=\"row collapse\">
                                    <div class=\"detail-description\">
                                        <div class=\"long_description\">";
                // line 90
                echo call_user_func_array($this->env->getFilter('markdown')->getCallable(), array($this->getAttribute($context["constant"], "description", array())));
                echo "</div>
                                        <table class=\"table\">
                                            ";
                // line 92
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["constant"], "tags", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["tagList"]) {
                    // line 93
                    echo "                                                <tr>
                                                    <th>
                                                        ";
                    // line 95
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["tagList"], 0, array()), "name", array()), "html", null, true);
                    echo "
                                                    </th>
                                                    <td>
                                                        ";
                    // line 98
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($context["tagList"]);
                    foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                        // line 99
                        echo "                                                            ";
                        echo call_user_func_array($this->env->getFilter('markdown')->getCallable(), array($this->getAttribute($context["tag"], "description", array())));
                        echo "
                                                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 101
                    echo "                                                    </td>
                                                </tr>
                                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tagList'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 104
                echo "                                        </table>
                                    </div>
                                </div>
                            </div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['constant'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 109
            echo "                    ";
        }
        // line 110
        echo "
                    ";
        // line 111
        $context["specialProperties"] = (($this->getAttribute(($context["node"] ?? null), "magicProperties", array())) ? ($this->getAttribute($this->getAttribute(($context["node"] ?? null), "inheritedProperties", array()), "merge", array(0 => $this->getAttribute(($context["node"] ?? null), "magicProperties", array())), "method")) : ($this->getAttribute(($context["node"] ?? null), "inheritedProperties", array())));
        // line 112
        echo "                    ";
        if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute(($context["node"] ?? null), "properties", array()), "merge", array(0 => ($context["specialProperties"] ?? null)), "method")) > 0)) {
            // line 113
            echo "                        <h3><i class=\"icon-custom icon-property\"></i> Properties</h3>
                        ";
            // line 114
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute(($context["node"] ?? null), "properties", array()), "merge", array(0 => ($context["specialProperties"] ?? null)), "method"));
            foreach ($context['_seq'] as $context["_key"] => $context["property"]) {
                // line 115
                echo "                            <a id=\"property_";
                echo twig_escape_filter($this->env, $this->getAttribute($context["property"], "name", array()), "html", null, true);
                echo "\"> </a>
                            <div class=\"element clickable property ";
                // line 116
                echo (($this->getAttribute($context["property"], "deprecated", array())) ? ("deprecated") : (""));
                echo " ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["property"], "visibility", array()), "html", null, true);
                echo " property_";
                echo twig_escape_filter($this->env, $this->getAttribute($context["property"], "name", array()), "html", null, true);
                echo ((($this->getAttribute($this->getAttribute($context["property"], "parent", array()), "name", array()) != $this->getAttribute(($context["node"] ?? null), "name", array()))) ? (" inherited") : (""));
                echo "\" data-toggle=\"collapse\" data-target=\".property_";
                echo twig_escape_filter($this->env, $this->getAttribute($context["property"], "name", array()), "html", null, true);
                echo " .collapse\">
                                <h2>";
                // line 117
                echo twig_escape_filter($this->env, (($this->getAttribute($context["property"], "summary", array())) ? ($this->getAttribute($context["property"], "summary", array())) : ((($this->getAttribute($this->getAttribute($this->getAttribute($context["property"], "var", array()), 0, array()), "description", array())) ? ($this->getAttribute($this->getAttribute($this->getAttribute($context["property"], "var", array()), 0, array()), "description", array())) : ($this->getAttribute($context["property"], "name", array()))))), "html", null, true);
                echo "</h2>
                                <pre>";
                // line 118
                echo twig_escape_filter($this->env, $this->getAttribute($context["property"], "name", array()), "html", null, true);
                echo " : ";
                echo twig_escape_filter($this->env, twig_join_filter($this->getAttribute($context["property"], "types", array()), "|"), "html", null, true);
                echo "</pre>
                                <div class=\"labels\">
                                    ";
                // line 120
                if (($this->getAttribute($this->getAttribute($context["property"], "parent", array()), "name", array()) != $this->getAttribute(($context["node"] ?? null), "name", array()))) {
                    echo "<span class=\"label\">inherited</span>";
                }
                // line 121
                echo "                                    ";
                if ($this->getAttribute($context["property"], "static", array())) {
                    echo "<span class=\"label\">static</span>";
                }
                // line 122
                echo "                                </div>
                                <div class=\"row collapse\">
                                    <div class=\"detail-description\">
                                        <div class=\"long_description\">";
                // line 125
                echo call_user_func_array($this->env->getFilter('markdown')->getCallable(), array($this->getAttribute($context["property"], "description", array())));
                echo "</div>

                                        <table class=\"table\">
                                            ";
                // line 128
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["property"], "tags", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["tagList"]) {
                    // line 129
                    echo "                                                <tr>
                                                    <th>
                                                        ";
                    // line 131
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["tagList"], 0, array()), "name", array()), "html", null, true);
                    echo "
                                                    </th>
                                                    <td>
                                                        ";
                    // line 134
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($context["tagList"]);
                    foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                        // line 135
                        echo "                                                            ";
                        echo call_user_func_array($this->env->getFilter('markdown')->getCallable(), array($this->getAttribute($context["tag"], "description", array())));
                        echo "
                                                        ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 137
                    echo "                                                    </td>
                                                </tr>
                                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tagList'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 140
                echo "                                        </table>

                                        ";
                // line 142
                if (($this->getAttribute($context["property"], "types", array()) && (twig_join_filter($this->getAttribute($context["property"], "types", array())) != "void"))) {
                    // line 143
                    echo "                                            <h3>Type(s)</h3>
                                            <code>";
                    // line 144
                    echo twig_join_filter(call_user_func_array($this->env->getFilter('route')->getCallable(), array($this->getAttribute($context["property"], "types", array()))), "|");
                    echo "</code>
                                        ";
                }
                // line 146
                echo "                                    </div>
                                </div>
                            </div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['property'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 150
            echo "                    ";
        }
        // line 151
        echo "                </div>
            </div>
            <a id=\"";
        // line 153
        echo twig_escape_filter($this->env, $this->getAttribute(($context["node"] ?? null), "fullyQualifiedStructuralElementName", array()), "html", null, true);
        echo "\"></a>
            <ul class=\"breadcrumb\">
                <li><a href=\"";
        // line 155
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array("index.html")), "html", null, true);
        echo "\"><i class=\"icon-custom icon-class\"></i></a></li>
                ";
        // line 156
        echo $context["macros"]->getbuildBreadcrumb($this->getAttribute(($context["node"] ?? null), "namespace", array()));
        echo "
                <li class=\"active\"><span class=\"divider\">\\</span><a href=\"";
        // line 157
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array(($context["node"] ?? null))), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["node"] ?? null), "name", array()), "html", null, true);
        echo "</a></li>
            </ul>
        </div>
    </div>

";
    }

    public function getTemplateName()
    {
        return "/class.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  541 => 157,  537 => 156,  533 => 155,  528 => 153,  524 => 151,  521 => 150,  512 => 146,  507 => 144,  504 => 143,  502 => 142,  498 => 140,  490 => 137,  481 => 135,  477 => 134,  471 => 131,  467 => 129,  463 => 128,  457 => 125,  452 => 122,  447 => 121,  443 => 120,  436 => 118,  432 => 117,  421 => 116,  416 => 115,  412 => 114,  409 => 113,  406 => 112,  404 => 111,  401 => 110,  398 => 109,  388 => 104,  380 => 101,  371 => 99,  367 => 98,  361 => 95,  357 => 93,  353 => 92,  348 => 90,  343 => 87,  339 => 86,  334 => 84,  330 => 83,  321 => 82,  316 => 81,  312 => 80,  309 => 79,  307 => 78,  304 => 77,  288 => 74,  286 => 73,  282 => 71,  277 => 70,  272 => 69,  267 => 68,  262 => 67,  258 => 66,  215 => 64,  211 => 63,  200 => 62,  195 => 61,  177 => 60,  175 => 59,  170 => 56,  164 => 55,  152 => 51,  146 => 49,  144 => 48,  140 => 46,  134 => 44,  132 => 43,  128 => 42,  124 => 40,  118 => 39,  114 => 38,  108 => 35,  102 => 32,  99 => 31,  93 => 29,  90 => 28,  84 => 26,  82 => 25,  77 => 23,  69 => 18,  60 => 11,  57 => 10,  48 => 7,  45 => 6,  41 => 1,  39 => 3,  33 => 1,  14 => 4,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "/class.html.twig", "phar:///Applications/MAMP/htdocs/TYPO3/Extensions/cf_google_authenticator/phpDocumentor.phar/src/phpDocumentor/../../data/templates/../templates/responsive-twig//class.html.twig");
    }
}
