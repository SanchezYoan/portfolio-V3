<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* base.html.twig */
class __TwigTemplate_2b4b6dbf9e8fdf44f63aabd8a5b23f3b extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'stylesheets' => [$this, 'block_stylesheets'],
            'javascripts' => [$this, 'block_javascripts'],
            'importmap' => [$this, 'block_importmap'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "base.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "base.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html>
\t<head>
\t\t<meta charset=\"UTF-8\">
\t\t<title>
\t\t\t";
        // line 6
        yield from $this->unwrap()->yieldBlock('title', $context, $blocks);
        // line 8
        yield "\t\t</title>
\t\t<link rel=\"icon\" href=\"data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 128 128%22><text y=%221.2em%22 font-size=%2296%22>⚫️</text><text y=%221.3em%22 x=%220.2em%22 font-size=%2276%22 fill=%22%23fff%22>sf</text></svg>\">
\t\t";
        // line 10
        yield from $this->unwrap()->yieldBlock('stylesheets', $context, $blocks);
        // line 11
        yield "        ";
        yield $this->extensions['Symfony\WebpackEncoreBundle\Twig\EntryFilesTwigExtension']->renderWebpackLinkTags("app");
        yield "

\t\t";
        // line 13
        yield from $this->unwrap()->yieldBlock('javascripts', $context, $blocks);
        // line 19
        yield "\t</head>
\t<body>
\t";
        // line 24
        yield "
\t";
        // line 26
        yield "\t\t<nav class=\"navbar bg-primary navbar-expand-lg\" data-bs-theme=\"dark\">
\t\t\t<div class=\"container-fluid\">
\t\t\t\t<a class=\"navbar-brand\" href=\"";
        // line 28
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("home");
        yield "\">YoanSAN</a>
\t\t\t\t<div class=\"d-flex justify-content-center align-items-center w-100\">
\t\t\t\t\t<ul class=\"navbar-nav me-3\">
\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t<a class=\"nav-link ";
        // line 32
        yield (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 32, $this->source); })()), "current_route", [], "any", false, false, false, 32) == "about.show")) ? ("active") : (""));
        yield "\" href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("about.show");
        yield "\">À propos</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li class=\"nav-item\">
\t\t\t\t\t\t\t<a class=\"nav-link ";
        // line 35
        yield (((is_string($_v0 = CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 35, $this->source); })()), "current_route", [], "any", false, false, false, 35)) && is_string($_v1 = "project.") && str_starts_with($_v0, $_v1))) ? ("active") : (""));
        yield "\" href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("project.index");
        yield "\">Projets</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t<a class=\"nav-link ";
        // line 38
        yield (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 38, $this->source); })()), "current_route", [], "any", false, false, false, 38) == "contact")) ? ("active") : (""));
        yield "\" href=\"";
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("contact");
        yield "\">Contact</a>
\t\t\t\t\t\t</li>

\t\t\t\t\t</ul>
\t\t\t\t</div>
\t\t\t\t<div class=\"d-flex justify-content-center align-items-center\">
\t\t\t\t\t<ul class=\"navbar-nav\">
\t\t\t\t\t\t";
        // line 45
        if ((($tmp =  !$this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_USER")) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 46
            yield "\t\t\t\t\t\t<div class=\"d-flex gap-2\">
\t\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t<button type=\"button\" class=\"btn btn-secondary\">
\t\t\t\t\t\t\t\t<a class=\"text-decoration-none text-white\" href=\"";
            // line 49
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("security.login");
            yield "\">Connexion</a>
\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t<button type=\"button\" class=\"btn btn-success\">
\t\t\t\t\t\t\t\t<a class=\"text-decoration-none text-white\" href=\"";
            // line 54
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("security.register");
            yield "\">Inscription</a>
\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t";
        }
        // line 58
        yield "\t\t\t\t\t\t";
        if ((($tmp = $this->extensions['Symfony\Bridge\Twig\Extension\SecurityExtension']->isGranted("ROLE_USER")) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            yield "\t
\t\t\t\t\t\t<div class=\"d-flex gap-2 align-items-center me-3\">
\t\t\t\t\t\t\t<li> 
\t\t\t\t\t\t\t\t<a class=\"nav-link ";
            // line 61
            yield (((CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 61, $this->source); })()), "current_route", [], "any", false, false, false, 61) == "profil")) ? ("active") : (""));
            yield "\" href=\"";
            yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getUrl("profil.index");
            yield "\">";
            yield $this->env->getRuntime('Symfony\UX\Icons\Twig\UXIconRuntime')->renderIcon("mdi:account-circle", ["width" => "2rem", "height" => "2rem"], ["class" => "text-white"]);
            yield "</a>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t
\t\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t\t<a class=\"text-decoration-none text-white\" href=\"";
            // line 65
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\LogoutUrlExtension']->getLogoutPath(), "html", null, true);
            yield "\">Déconnexion</a>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t";
        }
        // line 68
        yield "\t\t\t\t\t</ul>
\t\t\t\t</div>
\t\t\t\t</nav>
\t\t\t\t<div class=\"container my-3 col-6\">
\t\t\t\t\t
\t\t\t\t\t<div class=\"container my-4\">";
        // line 73
        yield from $this->load("partials/flash.html.twig", 73)->unwrap()->yield($context);
        // line 74
        yield "\t\t\t\t\t</div>
\t\t\t\t\t";
        // line 75
        yield from $this->unwrap()->yieldBlock('body', $context, $blocks);
        // line 78
        yield "\t\t\t\t</div>
\t\t\t</div>
\t</body>
</html>
";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    // line 6
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Welcome!
\t\t\t";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 10
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_stylesheets(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "stylesheets"));

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 13
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_javascripts(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "javascripts"));

        // line 14
        yield "            ";
        yield $this->extensions['Symfony\WebpackEncoreBundle\Twig\EntryFilesTwigExtension']->renderWebpackScriptTags("app");
        yield "
\t\t\t";
        // line 15
        yield from $this->unwrap()->yieldBlock('importmap', $context, $blocks);
        // line 18
        yield "\t\t";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 15
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_importmap(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "importmap"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "importmap"));

        // line 16
        yield "\t\t\t\t";
        yield $this->env->getRuntime('Symfony\Bridge\Twig\Extension\ImportMapRuntime')->importmap("app");
        yield "
\t\t\t";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    // line 75
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 76
        yield "\t\t\t\t\t
\t\t\t\t\t";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "base.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  314 => 76,  301 => 75,  287 => 16,  274 => 15,  263 => 18,  261 => 15,  256 => 14,  243 => 13,  221 => 10,  197 => 6,  182 => 78,  180 => 75,  177 => 74,  175 => 73,  168 => 68,  162 => 65,  151 => 61,  144 => 58,  137 => 54,  129 => 49,  124 => 46,  122 => 45,  110 => 38,  102 => 35,  94 => 32,  87 => 28,  83 => 26,  80 => 24,  76 => 19,  74 => 13,  68 => 11,  66 => 10,  62 => 8,  60 => 6,  53 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html>
\t<head>
\t\t<meta charset=\"UTF-8\">
\t\t<title>
\t\t\t{% block title %}Welcome!
\t\t\t{% endblock %}
\t\t</title>
\t\t<link rel=\"icon\" href=\"data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 128 128%22><text y=%221.2em%22 font-size=%2296%22>⚫️</text><text y=%221.3em%22 x=%220.2em%22 font-size=%2276%22 fill=%22%23fff%22>sf</text></svg>\">
\t\t{% block stylesheets %}{% endblock %}
        {{ encore_entry_link_tags('app') }}

\t\t{% block javascripts %}
            {{ encore_entry_script_tags('app') }}
\t\t\t{% block importmap %}
\t\t\t\t{{ importmap('app') }}
\t\t\t{% endblock %}
\t\t{% endblock %}
\t</head>
\t<body>
\t{# <div id=\"vue-app\">
\t\t\t\t\t
\t</div> #}

\t{# Passer A vue FULL #}
\t\t<nav class=\"navbar bg-primary navbar-expand-lg\" data-bs-theme=\"dark\">
\t\t\t<div class=\"container-fluid\">
\t\t\t\t<a class=\"navbar-brand\" href=\"{{ url(\"home\") }}\">YoanSAN</a>
\t\t\t\t<div class=\"d-flex justify-content-center align-items-center w-100\">
\t\t\t\t\t<ul class=\"navbar-nav me-3\">
\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t<a class=\"nav-link {{ app.current_route == 'about.show' ? 'active' : '' }}\" href=\"{{ url(\"about.show\") }}\">À propos</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li class=\"nav-item\">
\t\t\t\t\t\t\t<a class=\"nav-link {{ app.current_route starts with 'project.' ? 'active' : '' }}\" href=\"{{ url(\"project.index\") }}\">Projets</a>
\t\t\t\t\t\t</li>
\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t<a class=\"nav-link {{ app.current_route == 'contact' ? 'active' : '' }}\" href=\"{{ url(\"contact\") }}\">Contact</a>
\t\t\t\t\t\t</li>

\t\t\t\t\t</ul>
\t\t\t\t</div>
\t\t\t\t<div class=\"d-flex justify-content-center align-items-center\">
\t\t\t\t\t<ul class=\"navbar-nav\">
\t\t\t\t\t\t{% if not is_granted('ROLE_USER') %}
\t\t\t\t\t\t<div class=\"d-flex gap-2\">
\t\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t<button type=\"button\" class=\"btn btn-secondary\">
\t\t\t\t\t\t\t\t<a class=\"text-decoration-none text-white\" href=\"{{ url(\"security.login\") }}\">Connexion</a>
\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t<button type=\"button\" class=\"btn btn-success\">
\t\t\t\t\t\t\t\t<a class=\"text-decoration-none text-white\" href=\"{{ url(\"security.register\") }}\">Inscription</a>
\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t{% endif %}
\t\t\t\t\t\t{% if is_granted('ROLE_USER') %}\t
\t\t\t\t\t\t<div class=\"d-flex gap-2 align-items-center me-3\">
\t\t\t\t\t\t\t<li> 
\t\t\t\t\t\t\t\t<a class=\"nav-link {{ app.current_route == 'profil' ? 'active' : '' }}\" href=\"{{ url(\"profil.index\") }}\">{{ ux_icon('mdi:account-circle', {'width': '2rem', 'height': '2rem'}, {class: 'text-white'}) }}</a>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t
\t\t\t\t\t\t\t<li>
\t\t\t\t\t\t\t\t<a class=\"text-decoration-none text-white\" href=\"{{ logout_path() }}\">Déconnexion</a>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t{% endif %}
\t\t\t\t\t</ul>
\t\t\t\t</div>
\t\t\t\t</nav>
\t\t\t\t<div class=\"container my-3 col-6\">
\t\t\t\t\t
\t\t\t\t\t<div class=\"container my-4\">{% include 'partials/flash.html.twig' %}
\t\t\t\t\t</div>
\t\t\t\t\t{% block body %}
\t\t\t\t\t
\t\t\t\t\t{% endblock %}
\t\t\t\t</div>
\t\t\t</div>
\t</body>
</html>
", "base.html.twig", "/var/www/symfony/templates/base.html.twig");
    }
}
