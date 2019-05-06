<?php

/* base/class.sidebar.html.twig */
class __TwigTemplate_4635d637bfff09ab63a015c3eb077f06be633e73233136b7bb10776856941b46 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $_trait_0 = $this->loadTemplate("base/sidebar.html.twig", "base/class.sidebar.html.twig", 1);
        // line 1
        if (!$_trait_0->isTraitable()) {
            throw new Twig_Error_Runtime('Template "'."base/sidebar.html.twig".'" cannot be used as a trait.');
        }
        $_trait_0_blocks = $_trait_0->getBlocks();

        $this->traits = $_trait_0_blocks;

        $this->blocks = array_merge(
            $this->traits,
            array(
                'sidebar_buttons' => array($this, 'block_sidebar_buttons'),
                'sidebar_entry' => array($this, 'block_sidebar_entry'),
                'sidebar_content' => array($this, 'block_sidebar_content'),
            )
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        echo "
";
        // line 3
        $this->displayBlock('sidebar_buttons', $context, $blocks);
        // line 15
        echo "
";
        // line 16
        $this->displayBlock('sidebar_entry', $context, $blocks);
        // line 23
        echo "
";
        // line 24
        $this->displayBlock('sidebar_content', $context, $blocks);
    }

    // line 3
    public function block_sidebar_buttons($context, array $blocks = array())
    {
        // line 4
        echo "    <div class=\"btn-group view pull-right\" data-toggle=\"buttons-radio\">
        <button class=\"btn details\" title=\"Show descriptions and method names\"><i class=\"icon-list\"></i></button>
        <button class=\"btn simple\" title=\"Show only method names\"><i class=\"icon-align-justify\"></i></button>
    </div>
    <div class=\"btn-group visibility\" data-toggle=\"buttons-checkbox\">
        <button class=\"btn public active\" title=\"Show public elements\">Public</button>
        <button class=\"btn protected\" title=\"Show protected elements\">Protected</button>
        <button class=\"btn private\" title=\"Show private elements\">Private</button>
        <button class=\"btn inherited active\" title=\"Show inherited elements\">Inherited</button>
    </div>
";
    }

    // line 16
    public function block_sidebar_entry($context, array $blocks = array())
    {
        // line 17
        echo "    <li class=\"";
        echo twig_escape_filter($this->env, ($context["type"] ?? null), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "visibility", array()), "html", null, true);
        echo ((($this->getAttribute($this->getAttribute(($context["item"] ?? null), "parent", array()), "name", array()) != $this->getAttribute(($context["node"] ?? null), "name", array()))) ? (" inherited") : (""));
        echo "\">
        <a href=\"#";
        // line 18
        echo twig_escape_filter($this->env, ($context["type"] ?? null), "html", null, true);
        echo "_";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "name", array()), "html", null, true);
        echo "\" title=\"";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "name", array()), "html", null, true);
        echo " :: ";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "summary", array()), "html", null, true);
        echo "\">
            <span class=\"description\">";
        // line 19
        echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "summary", array()), "html", null, true);
        echo "</span><pre>";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["item"] ?? null), "name", array()), "html", null, true);
        echo "</pre>
        </a>
    </li>
";
    }

    // line 24
    public function block_sidebar_content($context, array $blocks = array())
    {
        // line 25
        echo "    <ul class=\"side-nav nav nav-list\">
        <li class=\"nav-header\">
            <i class=\"icon-custom icon-method\"></i> Methods
            <ul>
                ";
        // line 29
        $context["specialMethods"] = (($this->getAttribute(($context["node"] ?? null), "magicMethods", array())) ? ($this->getAttribute($this->getAttribute(($context["node"] ?? null), "inheritedMethods", array()), "merge", array(0 => $this->getAttribute(($context["node"] ?? null), "magicMethods", array())), "method")) : ($this->getAttribute(($context["node"] ?? null), "inheritedMethods", array())));
        // line 30
        echo "                ";
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
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 31
            echo "                    ";
            $context["type"] = "method";
            // line 32
            echo "                    ";
            if ((($this->getAttribute($context["item"], "visibility", array()) == "") || ($this->getAttribute($context["item"], "visibility", array()) == "public"))) {
                // line 33
                echo "                        ";
                $this->displayBlock("sidebar_entry", $context, $blocks);
                echo "
                    ";
            }
            // line 35
            echo "                ";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 36
        echo "            </ul>
        </li>
        <li class=\"nav-header protected\">» Protected
            <ul>
                ";
        // line 40
        $context["specialMethods"] = (($this->getAttribute(($context["node"] ?? null), "magicMethods", array())) ? ($this->getAttribute($this->getAttribute(($context["node"] ?? null), "inheritedMethods", array()), "merge", array(0 => $this->getAttribute(($context["node"] ?? null), "magicMethods", array())), "method")) : ($this->getAttribute(($context["node"] ?? null), "inheritedMethods", array())));
        // line 41
        echo "                ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(call_user_func_array($this->env->getFilter('sort_asc')->getCallable(), array("asc", $this->getAttribute($this->getAttribute(($context["node"] ?? null), "methods", array()), "merge", array(0 => ($context["specialMethods"] ?? null)), "method"))));
        foreach ($context['_seq'] as $context["_key"] => $context["method"]) {
            // line 42
            echo "                    ";
            if (($this->getAttribute($context["method"], "visibility", array()) == "protected")) {
                // line 43
                echo "                        <li class=\"method ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["method"], "visibility", array()), "html", null, true);
                echo ((($this->getAttribute($this->getAttribute($context["method"], "parent", array()), "name", array()) != $this->getAttribute(($context["node"] ?? null), "name", array()))) ? (" inherited") : (""));
                echo "\">
                            <a href=\"#method_";
                // line 44
                echo twig_escape_filter($this->env, $this->getAttribute($context["method"], "name", array()), "html", null, true);
                echo "\" title=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["method"], "name", array()), "html", null, true);
                echo " :: ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["method"], "summary", array()), "html", null, true);
                echo "\">
                                <span class=\"description\">";
                // line 45
                echo twig_escape_filter($this->env, $this->getAttribute($context["method"], "summary", array()), "html", null, true);
                echo "</span><pre>";
                echo twig_escape_filter($this->env, $this->getAttribute($context["method"], "name", array()), "html", null, true);
                echo "</pre>
                            </a>
                        </li>
                    ";
            }
            // line 49
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['method'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 50
        echo "            </ul>
        </li>
        <li class=\"nav-header private\">» Private
            <ul>
                ";
        // line 54
        $context["specialMethods"] = (($this->getAttribute(($context["node"] ?? null), "magicMethods", array())) ? ($this->getAttribute($this->getAttribute(($context["node"] ?? null), "inheritedMethods", array()), "merge", array(0 => $this->getAttribute(($context["node"] ?? null), "magicMethods", array())), "method")) : ($this->getAttribute(($context["node"] ?? null), "inheritedMethods", array())));
        // line 55
        echo "                ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(call_user_func_array($this->env->getFilter('sort_asc')->getCallable(), array("asc", $this->getAttribute($this->getAttribute(($context["node"] ?? null), "methods", array()), "merge", array(0 => ($context["specialMethods"] ?? null)), "method"))));
        foreach ($context['_seq'] as $context["_key"] => $context["method"]) {
            // line 56
            echo "                    ";
            if (($this->getAttribute($context["method"], "visibility", array()) == "private")) {
                // line 57
                echo "                        <li class=\"method ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["method"], "visibility", array()), "html", null, true);
                echo ((($this->getAttribute($this->getAttribute($context["method"], "parent", array()), "name", array()) != $this->getAttribute(($context["node"] ?? null), "name", array()))) ? (" inherited") : (""));
                echo "\">
                            <a href=\"#method_";
                // line 58
                echo twig_escape_filter($this->env, $this->getAttribute($context["method"], "name", array()), "html", null, true);
                echo "\" title=\"";
                echo twig_escape_filter($this->env, $this->getAttribute($context["method"], "name", array()), "html", null, true);
                echo " :: ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["method"], "summary", array()), "html", null, true);
                echo "\">
                                <span class=\"description\">";
                // line 59
                echo twig_escape_filter($this->env, $this->getAttribute($context["method"], "summary", array()), "html", null, true);
                echo "</span><pre>";
                echo twig_escape_filter($this->env, $this->getAttribute($context["method"], "name", array()), "html", null, true);
                echo "</pre>
                            </a>
                        </li>
                    ";
            }
            // line 63
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['method'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 64
        echo "            </ul>
        </li>
        <li class=\"nav-header\">
            <i class=\"icon-custom icon-constant\"></i> Constants
            <ul>
                ";
        // line 69
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(call_user_func_array($this->env->getFilter('sort_asc')->getCallable(), array("asc", $this->getAttribute($this->getAttribute(($context["node"] ?? null), "constants", array()), "merge", array(0 => $this->getAttribute(($context["node"] ?? null), "inheritedConstants", array())), "method"))));
        foreach ($context['_seq'] as $context["_key"] => $context["constant"]) {
            // line 70
            echo "                <li class=\"constant ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["constant"], "visibility", array()), "html", null, true);
            echo "\">
                    <a href=\"#constant_";
            // line 71
            echo twig_escape_filter($this->env, $this->getAttribute($context["constant"], "name", array()), "html", null, true);
            echo "\" title=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["constant"], "name", array()), "html", null, true);
            echo " :: ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["constant"], "summary", array()), "html", null, true);
            echo "\">
                        <span class=\"description\">";
            // line 72
            echo twig_escape_filter($this->env, $this->getAttribute($context["constant"], "summary", array()), "html", null, true);
            echo "</span><pre>";
            echo twig_escape_filter($this->env, $this->getAttribute($context["constant"], "name", array()), "html", null, true);
            echo "</pre>
                    </a>
                </li>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['constant'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 76
        echo "            </ul>
        </li>
    </ul>
";
    }

    public function getTemplateName()
    {
        return "base/class.sidebar.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  280 => 76,  268 => 72,  260 => 71,  255 => 70,  251 => 69,  244 => 64,  238 => 63,  229 => 59,  221 => 58,  215 => 57,  212 => 56,  207 => 55,  205 => 54,  199 => 50,  193 => 49,  184 => 45,  176 => 44,  170 => 43,  167 => 42,  162 => 41,  160 => 40,  154 => 36,  140 => 35,  134 => 33,  131 => 32,  128 => 31,  110 => 30,  108 => 29,  102 => 25,  99 => 24,  89 => 19,  79 => 18,  71 => 17,  68 => 16,  54 => 4,  51 => 3,  47 => 24,  44 => 23,  42 => 16,  39 => 15,  37 => 3,  34 => 2,  14 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "base/class.sidebar.html.twig", "phar:///Applications/MAMP/htdocs/TYPO3/Extensions/cf_google_authenticator/phpDocumentor.phar/src/phpDocumentor/../../data/templates/../templates/responsive-twig/base/class.sidebar.html.twig");
    }
}
