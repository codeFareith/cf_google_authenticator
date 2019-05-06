<?php

/* base/sidebar.html.twig */
class __TwigTemplate_a0f8a4fca1281a7ddb868562c2a806e0dca049fc9a7abf6ca75999697166c259 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'sidebar_buttons' => array($this, 'block_sidebar_buttons'),
            'sidebar_content' => array($this, 'block_sidebar_content'),
            'sidebar' => array($this, 'block_sidebar'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $this->displayBlock('sidebar_buttons', $context, $blocks);
        // line 2
        $this->displayBlock('sidebar_content', $context, $blocks);
        // line 3
        echo "
";
        // line 4
        $this->displayBlock('sidebar', $context, $blocks);
    }

    // line 1
    public function block_sidebar_buttons($context, array $blocks = array())
    {
    }

    // line 2
    public function block_sidebar_content($context, array $blocks = array())
    {
    }

    // line 4
    public function block_sidebar($context, array $blocks = array())
    {
        // line 5
        echo "    ";
        $this->displayBlock("sidebar_buttons", $context, $blocks);
        echo "
    ";
        // line 6
        $this->displayBlock("sidebar_content", $context, $blocks);
        echo "
";
    }

    public function getTemplateName()
    {
        return "base/sidebar.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  51 => 6,  46 => 5,  43 => 4,  38 => 2,  33 => 1,  29 => 4,  26 => 3,  24 => 2,  22 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "base/sidebar.html.twig", "phar:///Applications/MAMP/htdocs/TYPO3/Extensions/cf_google_authenticator/phpDocumentor.phar/src/phpDocumentor/../../data/templates/../templates/responsive-twig/base/sidebar.html.twig");
    }
}
