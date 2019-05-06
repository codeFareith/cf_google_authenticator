<?php

/* base/macros.html.twig */
class __TwigTemplate_ada6f55eee9509e7719ed260a2ce4eb10441b81e9f4d037e2dc708491b42d209 extends Twig_Template
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
        // line 8
        echo "
";
        // line 16
        echo "
";
        // line 24
        echo "
";
    }

    // line 1
    public function getrenderMarkerCounter($__files__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "files" => $__files__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 2
            echo "    ";
            $context["count"] = 0;
            // line 3
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["files"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["file"]) {
                // line 4
                echo "        ";
                $context["count"] = (($context["count"] ?? null) + twig_length_filter($this->env, $this->getAttribute($context["file"], "markers", array())));
                // line 5
                echo "    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['file'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 6
            echo "    <span class=\"label label-info\">";
            echo twig_escape_filter($this->env, ($context["count"] ?? null), "html", null, true);
            echo "</span>
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

    // line 9
    public function getrenderDeprecatedCounter($__elements__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "elements" => $__elements__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 10
            echo "    ";
            $context["count"] = 0;
            // line 11
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["elements"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["element"]) {
                if ($this->getAttribute($context["element"], "deprecated", array())) {
                    // line 12
                    echo "        ";
                    $context["count"] = (($context["count"] ?? null) + 1);
                    // line 13
                    echo "    ";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['element'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 14
            echo "    <span class=\"label label-info\">";
            echo twig_escape_filter($this->env, ($context["count"] ?? null), "html", null, true);
            echo "</span>
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

    // line 17
    public function getrenderErrorCounter($__files__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "files" => $__files__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 18
            echo "    ";
            $context["count"] = 0;
            // line 19
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["files"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["file"]) {
                // line 20
                echo "        ";
                $context["count"] = (($context["count"] ?? null) + twig_length_filter($this->env, $this->getAttribute($context["file"], "allerrors", array())));
                // line 21
                echo "    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['file'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 22
            echo "    <span class=\"label label-info\">";
            echo twig_escape_filter($this->env, ($context["count"] ?? null), "html", null, true);
            echo "</span>
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

    // line 25
    public function getbuildBreadcrumb($__element__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "element" => $__element__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 26
            echo "    ";
            $context["self"] = $this;
            // line 27
            echo "
    ";
            // line 28
            if (($this->getAttribute(($context["element"] ?? null), "parentNamespace", array()) && ($this->getAttribute($this->getAttribute(($context["element"] ?? null), "parentNamespace", array()), "name", array()) != "\\"))) {
                // line 29
                echo "        ";
                echo $context["self"]->getbuildBreadcrumb($this->getAttribute(($context["element"] ?? null), "parentNamespace", array()));
                echo "
    ";
            }
            // line 31
            echo "
    <li><span class=\"divider\">\\</span><a href=\"";
            // line 32
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('path')->getCallable(), array(($context["element"] ?? null))), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["element"] ?? null), "name", array()), "html", null, true);
            echo "</a></li>
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

    public function getTemplateName()
    {
        return "base/macros.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  202 => 32,  199 => 31,  193 => 29,  191 => 28,  188 => 27,  185 => 26,  173 => 25,  155 => 22,  149 => 21,  146 => 20,  141 => 19,  138 => 18,  126 => 17,  108 => 14,  101 => 13,  98 => 12,  92 => 11,  89 => 10,  77 => 9,  59 => 6,  53 => 5,  50 => 4,  45 => 3,  42 => 2,  30 => 1,  25 => 24,  22 => 16,  19 => 8,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "base/macros.html.twig", "phar:///Applications/MAMP/htdocs/TYPO3/Extensions/cf_google_authenticator/phpDocumentor.phar/src/phpDocumentor/../../data/templates/../templates/responsive-twig/base/macros.html.twig");
    }
}
