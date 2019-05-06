<?php

/* method.html.twig */
class __TwigTemplate_f5bbb4d674e2fdd6bee8f6dc1e241a0cbf63e8322fe9a5ffa909a7f021515bae extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $context["macros"] = $this->loadTemplate("base/macros.html.twig", "method.html.twig", 1);
        // line 2
        echo "
                            <div class=\"row collapse\">
                                <div class=\"detail-description\">
                                    <div class=\"long_description\">";
        // line 5
        echo call_user_func_array($this->env->getFilter('markdown')->getCallable(), array($this->getAttribute(($context["method"] ?? null), "description", array())));
        echo "</div>

                                    <table class=\"table\">
                                        ";
        // line 8
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["method"] ?? null), "tags", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["tagList"]) {
            if (!twig_in_filter($this->getAttribute($this->getAttribute($context["tagList"], 0, array()), "name", array()), array(0 => "param", 1 => "return", 2 => "api", 3 => "throws", 4 => "throw"))) {
                // line 9
                echo "                                            <tr>
                                                <th>
                                                    ";
                // line 11
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["tagList"], 0, array()), "name", array()), "html", null, true);
                echo "
                                                </th>
                                                <td>
                                                    ";
                // line 14
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($context["tagList"]);
                foreach ($context['_seq'] as $context["_key"] => $context["tag"]) {
                    // line 15
                    echo "                                                        ";
                    if ((($this->getAttribute($context["tag"], "name", array()) == "since") || "deprecated")) {
                        // line 16
                        echo "                                                            ";
                        echo twig_escape_filter($this->env, $this->getAttribute($context["tag"], "version", array()), "html", null, true);
                        echo "
                                                        ";
                    }
                    // line 18
                    echo "                                                        ";
                    if (($this->getAttribute($context["tag"], "name", array()) == "see")) {
                        // line 19
                        echo "                                                            ";
                        echo call_user_func_array($this->env->getFilter('route')->getCallable(), array($this->getAttribute($context["tag"], "reference", array())));
                        echo "
                                                        ";
                    }
                    // line 21
                    echo "                                                        ";
                    echo call_user_func_array($this->env->getFilter('markdown')->getCallable(), array($this->getAttribute($context["tag"], "description", array())));
                    echo "
                                                    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tag'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 23
                echo "                                                </td>
                                            </tr>
                                        ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['tagList'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 26
        echo "                                        ";
        if (((twig_length_filter($this->env, $this->getAttribute($this->getAttribute(($context["method"] ?? null), "tags", array()), "throws", array())) > 0) || (twig_length_filter($this->env, $this->getAttribute($this->getAttribute(($context["method"] ?? null), "tags", array()), "throw", array())) > 0))) {
            // line 27
            echo "                                            <tr>
                                                <th>Throws</th>
                                                <td>
                                                    <dl>
                                                    ";
            // line 31
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute(($context["method"] ?? null), "tags", array()), "throws", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["exception"]) {
                // line 32
                echo "                                                        <dt>";
                echo twig_join_filter(call_user_func_array($this->env->getFilter('route')->getCallable(), array($this->getAttribute($context["exception"], "types", array()))), "|");
                echo "</dt>
                                                        <dd>";
                // line 33
                echo call_user_func_array($this->env->getFilter('markdown')->getCallable(), array($this->getAttribute($context["exception"], "description", array())));
                echo "</dd>
                                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['exception'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 35
            echo "                                                    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute(($context["method"] ?? null), "tags", array()), "throw", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["exception"]) {
                // line 36
                echo "                                                        <dt>";
                echo twig_join_filter(call_user_func_array($this->env->getFilter('route')->getCallable(), array($this->getAttribute($context["exception"], "types", array()))), "|");
                echo "</dt>
                                                        <dd>";
                // line 37
                echo call_user_func_array($this->env->getFilter('markdown')->getCallable(), array($this->getAttribute($context["exception"], "description", array())));
                echo "</dd>
                                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['exception'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 39
            echo "                                                    </dl>
                                                </td>
                                            </tr>
                                        ";
        }
        // line 43
        echo "                                    </table>

                                    ";
        // line 45
        if ((twig_length_filter($this->env, $this->getAttribute(($context["method"] ?? null), "arguments", array())) > 0)) {
            // line 46
            echo "                                        <h3>Arguments</h3>
                                        ";
            // line 47
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["method"] ?? null), "arguments", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["argument"]) {
                // line 48
                echo "                                            <div class=\"subelement argument\">
                                                <h4>";
                // line 49
                echo twig_escape_filter($this->env, $this->getAttribute($context["argument"], "name", array()), "html", null, true);
                echo "</h4>
                                                <code>";
                // line 50
                echo twig_join_filter(call_user_func_array($this->env->getFilter('route')->getCallable(), array($this->getAttribute($context["argument"], "types", array()))), "|");
                echo "</code><p>";
                echo call_user_func_array($this->env->getFilter('markdown')->getCallable(), array($this->getAttribute($context["argument"], "description", array())));
                echo "</p>
                                            </div>
                                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['argument'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 53
            echo "                                    ";
        }
        // line 54
        echo "
                                    ";
        // line 55
        if (($this->getAttribute($this->getAttribute(($context["method"] ?? null), "response", array()), "types", array()) && (twig_join_filter($this->getAttribute($this->getAttribute(($context["method"] ?? null), "response", array()), "types", array())) != "void"))) {
            // line 56
            echo "                                        <h3>Response</h3>
                                        <code>";
            // line 57
            echo twig_join_filter(call_user_func_array($this->env->getFilter('route')->getCallable(), array($this->getAttribute($this->getAttribute(($context["method"] ?? null), "response", array()), "types", array()))), "|");
            echo "</code><p>";
            echo call_user_func_array($this->env->getFilter('markdown')->getCallable(), array($this->getAttribute($this->getAttribute(($context["method"] ?? null), "response", array()), "description", array())));
            echo "</p>
                                    ";
        }
        // line 59
        echo "                                </div>
                            </div>
";
    }

    public function getTemplateName()
    {
        return "method.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  186 => 59,  179 => 57,  176 => 56,  174 => 55,  171 => 54,  168 => 53,  157 => 50,  153 => 49,  150 => 48,  146 => 47,  143 => 46,  141 => 45,  137 => 43,  131 => 39,  123 => 37,  118 => 36,  113 => 35,  105 => 33,  100 => 32,  96 => 31,  90 => 27,  87 => 26,  78 => 23,  69 => 21,  63 => 19,  60 => 18,  54 => 16,  51 => 15,  47 => 14,  41 => 11,  37 => 9,  32 => 8,  26 => 5,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "method.html.twig", "phar:///Applications/MAMP/htdocs/TYPO3/Extensions/cf_google_authenticator/phpDocumentor.phar/src/phpDocumentor/../../data/templates/../templates/responsive-twig/method.html.twig");
    }
}
