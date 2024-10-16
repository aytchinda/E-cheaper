<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Cheaper Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-4.37.2.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-4.37.2.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-GETapi-user">
                                <a href="#endpoints-GETapi-user">GET api/user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-products">
                                <a href="#endpoints-GETapi-products">GET api/products</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-products--id-">
                                <a href="#endpoints-GETapi-products--id-">GET api/products/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-products">
                                <a href="#endpoints-POSTapi-products">POST api/products</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-products--id-">
                                <a href="#endpoints-PUTapi-products--id-">PUT api/products/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-products--id-">
                                <a href="#endpoints-DELETEapi-products--id-">DELETE api/products/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-generate-token">
                                <a href="#endpoints-POSTapi-generate-token">POST api/generate-token</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: October 10, 2024</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>http://localhost</code>
</aside>
<p>This documentation aims to provide all the information you need to work with our API.</p>
<aside>As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).</aside>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>To authenticate requests, include an <strong><code>Authorization</code></strong> header with the value <strong><code>"Bearer {YOUR_AUTH_KEY}"</code></strong>.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>
<p>You can retrieve your token by visiting your dashboard and clicking <b>Generate API token</b>.</p>

        <h1 id="endpoints">Endpoints</h1>

    

                                <h2 id="endpoints-GETapi-user">GET api/user</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-user">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/user" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/user"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-user">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 59
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 25,
    &quot;name&quot;: &quot;Test&quot;,
    &quot;email&quot;: &quot;test@gmail.com&quot;,
    &quot;email_verified_at&quot;: null,
    &quot;created_at&quot;: &quot;2024-09-16T18:17:25.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2024-09-16T20:22:47.000000Z&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-user" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-user"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-user"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-user" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-user">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-user" data-method="GET"
      data-path="api/user"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-user', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-user"
                    onclick="tryItOut('GETapi-user');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-user"
                    onclick="cancelTryOut('GETapi-user');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-user"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/user</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-user"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-products">GET api/products</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-products">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/products" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/products"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-products">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 58
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 1,
        &quot;category_id&quot;: 1,
        &quot;name&quot;: &quot;Ensemble Gants et Bonnet&quot;,
        &quot;slug&quot;: &quot;ensemble-gants-et-bonnet&quot;,
        &quot;description&quot;: &quot;couvrez vous&quot;,
        &quot;moreDescrciption&quot;: &quot;Restez au chaud &agrave; prix tres abordables ,&quot;,
        &quot;additionalInfos&quot;: &quot;&lt;p&gt;nous pensons aux personnes en situration pr&eacute;caire&amp;nbsp;&lt;/p&gt;&quot;,
        &quot;stock&quot;: 25,
        &quot;soldePrice&quot;: &quot;3.99&quot;,
        &quot;regularPrice&quot;: &quot;15.99&quot;,
        &quot;imageUrls&quot;: &quot;[\&quot;images\\/66e87a590c157_istockphoto-1578054137-612x612.jpg\&quot;]&quot;,
        &quot;brand&quot;: &quot;Zora&quot;,
        &quot;isAvailable&quot;: true,
        &quot;isBestSeller&quot;: true,
        &quot;isNewArrival&quot;: false,
        &quot;isFeatured&quot;: false,
        &quot;isSpecialOffer&quot;: false,
        &quot;created_at&quot;: &quot;2024-09-16T18:35:05.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-09-16T18:35:05.000000Z&quot;
    },
    {
        &quot;id&quot;: 2,
        &quot;category_id&quot;: 3,
        &quot;name&quot;: &quot;Ensemble Top et jupe&quot;,
        &quot;slug&quot;: &quot;ensemble-top-et-jupe&quot;,
        &quot;description&quot;: &quot;Magnifique ensemble classe et styl&eacute;&quot;,
        &quot;moreDescrciption&quot;: &quot;Fashion style&quot;,
        &quot;additionalInfos&quot;: &quot;&lt;p&gt;top&lt;/p&gt;&quot;,
        &quot;stock&quot;: 15,
        &quot;soldePrice&quot;: &quot;6.99&quot;,
        &quot;regularPrice&quot;: &quot;19.99&quot;,
        &quot;imageUrls&quot;: &quot;[\&quot;images\\/66e87aeae9c81_1.webp\&quot;]&quot;,
        &quot;brand&quot;: &quot;HetM&quot;,
        &quot;isAvailable&quot;: false,
        &quot;isBestSeller&quot;: false,
        &quot;isNewArrival&quot;: true,
        &quot;isFeatured&quot;: true,
        &quot;isSpecialOffer&quot;: false,
        &quot;created_at&quot;: &quot;2024-09-16T18:37:30.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-09-16T18:37:30.000000Z&quot;
    },
    {
        &quot;id&quot;: 3,
        &quot;category_id&quot;: 3,
        &quot;name&quot;: &quot;Robe de soiree&quot;,
        &quot;slug&quot;: &quot;robe-de-soiree&quot;,
        &quot;description&quot;: &quot;Robe &eacute;l&eacute;gante pour soir&eacute;e&quot;,
        &quot;moreDescrciption&quot;: &quot;magnifique&quot;,
        &quot;additionalInfos&quot;: &quot;&lt;p&gt;Robe de soiree magnifique&amp;nbsp;&lt;/p&gt;&quot;,
        &quot;stock&quot;: 15,
        &quot;soldePrice&quot;: &quot;2.95&quot;,
        &quot;regularPrice&quot;: &quot;17.99&quot;,
        &quot;imageUrls&quot;: &quot;[\&quot;images\\/66e87bf69c3c1_5.webp\&quot;]&quot;,
        &quot;brand&quot;: &quot;EPFC&quot;,
        &quot;isAvailable&quot;: true,
        &quot;isBestSeller&quot;: false,
        &quot;isNewArrival&quot;: true,
        &quot;isFeatured&quot;: true,
        &quot;isSpecialOffer&quot;: true,
        &quot;created_at&quot;: &quot;2024-09-16T18:41:58.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-09-16T18:41:58.000000Z&quot;
    },
    {
        &quot;id&quot;: 4,
        &quot;category_id&quot;: 2,
        &quot;name&quot;: &quot;Chemise Blanc et Noir&quot;,
        &quot;slug&quot;: &quot;chemise-blanc-et-noir&quot;,
        &quot;description&quot;: &quot;Chemise pour Hommes&quot;,
        &quot;moreDescrciption&quot;: &quot;soyez &eacute;legant &agrave; moindre cout&quot;,
        &quot;additionalInfos&quot;: &quot;&lt;p&gt;&hellip;&hellip;..&lt;/p&gt;&quot;,
        &quot;stock&quot;: 15,
        &quot;soldePrice&quot;: &quot;4.55&quot;,
        &quot;regularPrice&quot;: &quot;25.76&quot;,
        &quot;imageUrls&quot;: &quot;[\&quot;images\\/66e87c6491d80_istockphoto-165685498-612x612.jpg\&quot;]&quot;,
        &quot;brand&quot;: &quot;Zarra&quot;,
        &quot;isAvailable&quot;: false,
        &quot;isBestSeller&quot;: true,
        &quot;isNewArrival&quot;: true,
        &quot;isFeatured&quot;: false,
        &quot;isSpecialOffer&quot;: true,
        &quot;created_at&quot;: &quot;2024-09-16T18:43:48.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-09-16T18:43:48.000000Z&quot;
    },
    {
        &quot;id&quot;: 5,
        &quot;category_id&quot;: 2,
        &quot;name&quot;: &quot;Ensemble Costume&quot;,
        &quot;slug&quot;: &quot;ensemble-costume&quot;,
        &quot;description&quot;: &quot;Costme pour homme&quot;,
        &quot;moreDescrciption&quot;: &quot;joli&quot;,
        &quot;additionalInfos&quot;: &quot;&lt;p&gt;&hellip;&lt;/p&gt;&quot;,
        &quot;stock&quot;: 3,
        &quot;soldePrice&quot;: &quot;9.99&quot;,
        &quot;regularPrice&quot;: &quot;35.99&quot;,
        &quot;imageUrls&quot;: &quot;[\&quot;images\\/66e87cb8df31d_istockphoto-1430978895-612x612.jpg\&quot;]&quot;,
        &quot;brand&quot;: &quot;Primerrrk&quot;,
        &quot;isAvailable&quot;: false,
        &quot;isBestSeller&quot;: true,
        &quot;isNewArrival&quot;: true,
        &quot;isFeatured&quot;: true,
        &quot;isSpecialOffer&quot;: false,
        &quot;created_at&quot;: &quot;2024-09-16T18:45:12.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-09-16T18:45:12.000000Z&quot;
    },
    {
        &quot;id&quot;: 6,
        &quot;category_id&quot;: 3,
        &quot;name&quot;: &quot;Jupe simili cuir&quot;,
        &quot;slug&quot;: &quot;jupe-simili-cuir&quot;,
        &quot;description&quot;: &quot;Affirmez votre style&quot;,
        &quot;moreDescrciption&quot;: &quot;Jupe simili cuir&quot;,
        &quot;additionalInfos&quot;: &quot;&lt;p&gt;&hellip;&lt;/p&gt;&quot;,
        &quot;stock&quot;: 15,
        &quot;soldePrice&quot;: &quot;5.76&quot;,
        &quot;regularPrice&quot;: &quot;9.99&quot;,
        &quot;imageUrls&quot;: &quot;[\&quot;images\\/66e87d0d7a1d1_1.webp\&quot;]&quot;,
        &quot;brand&quot;: &quot;Zora&quot;,
        &quot;isAvailable&quot;: true,
        &quot;isBestSeller&quot;: true,
        &quot;isNewArrival&quot;: true,
        &quot;isFeatured&quot;: true,
        &quot;isSpecialOffer&quot;: true,
        &quot;created_at&quot;: &quot;2024-09-16T18:46:37.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-09-16T18:46:37.000000Z&quot;
    },
    {
        &quot;id&quot;: 7,
        &quot;category_id&quot;: 3,
        &quot;name&quot;: &quot;Bottines&quot;,
        &quot;slug&quot;: &quot;bottines&quot;,
        &quot;description&quot;: &quot;Botine d&#039;hiver&quot;,
        &quot;moreDescrciption&quot;: &quot;Bottes&quot;,
        &quot;additionalInfos&quot;: &quot;&lt;p&gt;&hellip;&lt;/p&gt;&quot;,
        &quot;stock&quot;: 15,
        &quot;soldePrice&quot;: &quot;7.50&quot;,
        &quot;regularPrice&quot;: &quot;17.70&quot;,
        &quot;imageUrls&quot;: &quot;[\&quot;images\\/66e87d82665af_istockphoto-1191174327-612x612.jpg\&quot;]&quot;,
        &quot;brand&quot;: &quot;Diessel&quot;,
        &quot;isAvailable&quot;: false,
        &quot;isBestSeller&quot;: true,
        &quot;isNewArrival&quot;: true,
        &quot;isFeatured&quot;: false,
        &quot;isSpecialOffer&quot;: true,
        &quot;created_at&quot;: &quot;2024-09-16T18:48:34.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-09-16T18:48:34.000000Z&quot;
    },
    {
        &quot;id&quot;: 8,
        &quot;category_id&quot;: 5,
        &quot;name&quot;: &quot;Chaussures de courses Unisex&quot;,
        &quot;slug&quot;: &quot;chaussures-de-courses-unisex&quot;,
        &quot;description&quot;: &quot;tres l&eacute;ger&quot;,
        &quot;moreDescrciption&quot;: &quot;chaussures de courses&quot;,
        &quot;additionalInfos&quot;: &quot;&lt;p&gt;&hellip;&lt;/p&gt;&quot;,
        &quot;stock&quot;: 3,
        &quot;soldePrice&quot;: &quot;11.50&quot;,
        &quot;regularPrice&quot;: &quot;24.99&quot;,
        &quot;imageUrls&quot;: &quot;[\&quot;images\\/66e87e113b266_istockphoto-1453810805-612x612.jpg\&quot;]&quot;,
        &quot;brand&quot;: &quot;Abibas&quot;,
        &quot;isAvailable&quot;: true,
        &quot;isBestSeller&quot;: true,
        &quot;isNewArrival&quot;: false,
        &quot;isFeatured&quot;: false,
        &quot;isSpecialOffer&quot;: true,
        &quot;created_at&quot;: &quot;2024-09-16T18:50:57.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-09-16T18:50:57.000000Z&quot;
    },
    {
        &quot;id&quot;: 9,
        &quot;category_id&quot;: 4,
        &quot;name&quot;: &quot;Planche &agrave; d&eacute;couper&quot;,
        &quot;slug&quot;: &quot;planche-a-decouper&quot;,
        &quot;description&quot;: &quot;en Bois&quot;,
        &quot;moreDescrciption&quot;: &quot;cuisine&quot;,
        &quot;additionalInfos&quot;: &quot;&lt;p&gt;&hellip;&lt;/p&gt;&quot;,
        &quot;stock&quot;: 29,
        &quot;soldePrice&quot;: &quot;1.50&quot;,
        &quot;regularPrice&quot;: &quot;5.99&quot;,
        &quot;imageUrls&quot;: &quot;[\&quot;images\\/66e87e93b729b_istockphoto-2160970399-612x612.jpg\&quot;]&quot;,
        &quot;brand&quot;: &quot;Ikoueya&quot;,
        &quot;isAvailable&quot;: true,
        &quot;isBestSeller&quot;: false,
        &quot;isNewArrival&quot;: false,
        &quot;isFeatured&quot;: true,
        &quot;isSpecialOffer&quot;: true,
        &quot;created_at&quot;: &quot;2024-09-16T18:53:07.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-09-16T18:53:07.000000Z&quot;
    },
    {
        &quot;id&quot;: 10,
        &quot;category_id&quot;: 4,
        &quot;name&quot;: &quot;Set de Spatules&quot;,
        &quot;slug&quot;: &quot;set-de-spatules&quot;,
        &quot;description&quot;: &quot;louches et spatules&quot;,
        &quot;moreDescrciption&quot;: &quot;...&quot;,
        &quot;additionalInfos&quot;: &quot;&lt;p&gt;&hellip;&lt;/p&gt;&quot;,
        &quot;stock&quot;: 2,
        &quot;soldePrice&quot;: &quot;3.29&quot;,
        &quot;regularPrice&quot;: &quot;6.88&quot;,
        &quot;imageUrls&quot;: &quot;[\&quot;images\\/66e87edd49f15_istockphoto-1676176264-612x612.jpg\&quot;]&quot;,
        &quot;brand&quot;: &quot;Ikoueya&quot;,
        &quot;isAvailable&quot;: true,
        &quot;isBestSeller&quot;: true,
        &quot;isNewArrival&quot;: true,
        &quot;isFeatured&quot;: true,
        &quot;isSpecialOffer&quot;: true,
        &quot;created_at&quot;: &quot;2024-09-16T18:54:21.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-09-16T18:54:21.000000Z&quot;
    },
    {
        &quot;id&quot;: 11,
        &quot;category_id&quot;: 3,
        &quot;name&quot;: &quot;Short de sport&quot;,
        &quot;slug&quot;: &quot;short-de-sport&quot;,
        &quot;description&quot;: &quot;sportivement&quot;,
        &quot;moreDescrciption&quot;: &quot;bien&quot;,
        &quot;additionalInfos&quot;: &quot;&lt;p&gt;tres bien&amp;nbsp;&lt;/p&gt;&quot;,
        &quot;stock&quot;: 3,
        &quot;soldePrice&quot;: &quot;2.50&quot;,
        &quot;regularPrice&quot;: &quot;5.99&quot;,
        &quot;imageUrls&quot;: &quot;[\&quot;images\\/66e87f2249347_6.png\&quot;]&quot;,
        &quot;brand&quot;: &quot;Zarra&quot;,
        &quot;isAvailable&quot;: true,
        &quot;isBestSeller&quot;: true,
        &quot;isNewArrival&quot;: true,
        &quot;isFeatured&quot;: true,
        &quot;isSpecialOffer&quot;: true,
        &quot;created_at&quot;: &quot;2024-09-16T18:55:30.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-09-16T18:55:30.000000Z&quot;
    },
    {
        &quot;id&quot;: 14,
        &quot;category_id&quot;: 6,
        &quot;name&quot;: &quot;SmartPhone&quot;,
        &quot;slug&quot;: &quot;smartphone&quot;,
        &quot;description&quot;: &quot;Iphone 11&quot;,
        &quot;moreDescrciption&quot;: &quot;128g&quot;,
        &quot;additionalInfos&quot;: &quot;&lt;p&gt;Camera frontale 13MP , Camera arriere 20MP&lt;/p&gt;&quot;,
        &quot;stock&quot;: 2,
        &quot;soldePrice&quot;: &quot;190.55&quot;,
        &quot;regularPrice&quot;: &quot;399.99&quot;,
        &quot;imageUrls&quot;: &quot;[\&quot;images\\/6706111ab88c8_iphone11.jpeg\&quot;]&quot;,
        &quot;brand&quot;: &quot;Apple&quot;,
        &quot;isAvailable&quot;: true,
        &quot;isBestSeller&quot;: false,
        &quot;isNewArrival&quot;: true,
        &quot;isFeatured&quot;: false,
        &quot;isSpecialOffer&quot;: false,
        &quot;created_at&quot;: &quot;2024-10-09T05:14:02.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-10-09T05:49:57.000000Z&quot;
    },
    {
        &quot;id&quot;: 15,
        &quot;category_id&quot;: 6,
        &quot;name&quot;: &quot;SmartPhone&quot;,
        &quot;slug&quot;: &quot;smartphone&quot;,
        &quot;description&quot;: &quot;Iphone12&quot;,
        &quot;moreDescrciption&quot;: &quot;64g&quot;,
        &quot;additionalInfos&quot;: &quot;&lt;p&gt;Camera frontale 13MP, Camera arriere 25MP&lt;/p&gt;&quot;,
        &quot;stock&quot;: 3,
        &quot;soldePrice&quot;: &quot;220.99&quot;,
        &quot;regularPrice&quot;: &quot;654.77&quot;,
        &quot;imageUrls&quot;: &quot;[\&quot;images\\/670613c77c394_iphone12.jpeg\&quot;]&quot;,
        &quot;brand&quot;: &quot;Apple&quot;,
        &quot;isAvailable&quot;: true,
        &quot;isBestSeller&quot;: false,
        &quot;isNewArrival&quot;: true,
        &quot;isFeatured&quot;: false,
        &quot;isSpecialOffer&quot;: false,
        &quot;created_at&quot;: &quot;2024-10-09T05:25:27.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-10-09T05:45:07.000000Z&quot;
    },
    {
        &quot;id&quot;: 16,
        &quot;category_id&quot;: 6,
        &quot;name&quot;: &quot;Pc portable&quot;,
        &quot;slug&quot;: &quot;pc-portable&quot;,
        &quot;description&quot;: &quot;Dell Latitude occasion&quot;,
        &quot;moreDescrciption&quot;: &quot;Pc portable reconditionn&eacute; 256 giga de m&eacute;moire et RAM 8giga&quot;,
        &quot;additionalInfos&quot;: &quot;&lt;p&gt;redonnez une nouvelles vie a ce pc&amp;nbsp;&lt;/p&gt;&quot;,
        &quot;stock&quot;: 1,
        &quot;soldePrice&quot;: &quot;99.99&quot;,
        &quot;regularPrice&quot;: &quot;299.99&quot;,
        &quot;imageUrls&quot;: &quot;[\&quot;images\\/6706ad617913d_dellLatitude34.jpeg\&quot;]&quot;,
        &quot;brand&quot;: &quot;Dell&quot;,
        &quot;isAvailable&quot;: true,
        &quot;isBestSeller&quot;: false,
        &quot;isNewArrival&quot;: false,
        &quot;isFeatured&quot;: false,
        &quot;isSpecialOffer&quot;: false,
        &quot;created_at&quot;: &quot;2024-10-09T16:20:49.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-10-09T16:20:49.000000Z&quot;
    },
    {
        &quot;id&quot;: 17,
        &quot;category_id&quot;: 6,
        &quot;name&quot;: &quot;Pc Portable&quot;,
        &quot;slug&quot;: &quot;pc-portable&quot;,
        &quot;description&quot;: &quot;Asus New generation&quot;,
        &quot;moreDescrciption&quot;: &quot;256 Gigas de m&eacute;moir et 8 Giga de RAM&quot;,
        &quot;additionalInfos&quot;: &quot;&lt;p&gt;offre de deuxi&egrave;me main&amp;nbsp;&lt;/p&gt;&quot;,
        &quot;stock&quot;: 1,
        &quot;soldePrice&quot;: &quot;99.99&quot;,
        &quot;regularPrice&quot;: &quot;320.99&quot;,
        &quot;imageUrls&quot;: &quot;[\&quot;images\\/6706adf151b1f_asus.jpeg\&quot;]&quot;,
        &quot;brand&quot;: &quot;Asus&quot;,
        &quot;isAvailable&quot;: true,
        &quot;isBestSeller&quot;: false,
        &quot;isNewArrival&quot;: false,
        &quot;isFeatured&quot;: false,
        &quot;isSpecialOffer&quot;: false,
        &quot;created_at&quot;: &quot;2024-10-09T16:23:13.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-10-09T16:23:13.000000Z&quot;
    },
    {
        &quot;id&quot;: 18,
        &quot;category_id&quot;: 7,
        &quot;name&quot;: &quot;Pc Portable&quot;,
        &quot;slug&quot;: &quot;pc-portable&quot;,
        &quot;description&quot;: &quot;Thinkpad Lenovo T480&quot;,
        &quot;moreDescrciption&quot;: &quot;120Giga de memoire , 8 Giga de ram&quot;,
        &quot;additionalInfos&quot;: &quot;&lt;p&gt;vos articles en seconde main&amp;nbsp;&lt;/p&gt;&quot;,
        &quot;stock&quot;: 2,
        &quot;soldePrice&quot;: &quot;79.99&quot;,
        &quot;regularPrice&quot;: &quot;278.96&quot;,
        &quot;imageUrls&quot;: &quot;[\&quot;images\\/6706bee33fd86_lenovothinkpadT480.jpeg\&quot;]&quot;,
        &quot;brand&quot;: &quot;Lenovo&quot;,
        &quot;isAvailable&quot;: true,
        &quot;isBestSeller&quot;: false,
        &quot;isNewArrival&quot;: true,
        &quot;isFeatured&quot;: false,
        &quot;isSpecialOffer&quot;: false,
        &quot;created_at&quot;: &quot;2024-10-09T17:35:31.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-10-09T17:35:31.000000Z&quot;
    },
    {
        &quot;id&quot;: 19,
        &quot;category_id&quot;: 7,
        &quot;name&quot;: &quot;Rame de papier&quot;,
        &quot;slug&quot;: &quot;rame-de-papier&quot;,
        &quot;description&quot;: &quot;format A4&quot;,
        &quot;moreDescrciption&quot;: &quot;Rames de papier format A4&quot;,
        &quot;additionalInfos&quot;: &quot;&lt;p&gt;a moindre cout&lt;/p&gt;&quot;,
        &quot;stock&quot;: 12,
        &quot;soldePrice&quot;: &quot;2.99&quot;,
        &quot;regularPrice&quot;: &quot;4.55&quot;,
        &quot;imageUrls&quot;: &quot;[\&quot;images\\/6706c79b633e8_rame paierA4.jpeg\&quot;]&quot;,
        &quot;brand&quot;: &quot;A4&quot;,
        &quot;isAvailable&quot;: true,
        &quot;isBestSeller&quot;: false,
        &quot;isNewArrival&quot;: true,
        &quot;isFeatured&quot;: false,
        &quot;isSpecialOffer&quot;: false,
        &quot;created_at&quot;: &quot;2024-10-09T18:12:43.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-10-09T18:12:43.000000Z&quot;
    },
    {
        &quot;id&quot;: 20,
        &quot;category_id&quot;: 7,
        &quot;name&quot;: &quot;Set style , Crayons&quot;,
        &quot;slug&quot;: &quot;set-style-crayons&quot;,
        &quot;description&quot;: &quot;Stylos  Bic , crayon et Gommes&quot;,
        &quot;moreDescrciption&quot;: &quot;indispensables pour les notes&quot;,
        &quot;additionalInfos&quot;: &quot;&lt;p&gt;notes&amp;nbsp;&lt;/p&gt;&quot;,
        &quot;stock&quot;: 5,
        &quot;soldePrice&quot;: &quot;0.99&quot;,
        &quot;regularPrice&quot;: &quot;2.50&quot;,
        &quot;imageUrls&quot;: &quot;[\&quot;images\\/6706c7f1e3ba4_set stylo.jpeg\&quot;]&quot;,
        &quot;brand&quot;: &quot;Bic&quot;,
        &quot;isAvailable&quot;: true,
        &quot;isBestSeller&quot;: false,
        &quot;isNewArrival&quot;: true,
        &quot;isFeatured&quot;: false,
        &quot;isSpecialOffer&quot;: false,
        &quot;created_at&quot;: &quot;2024-10-09T18:14:09.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-10-09T18:14:09.000000Z&quot;
    },
    {
        &quot;id&quot;: 21,
        &quot;category_id&quot;: 7,
        &quot;name&quot;: &quot;Sac Pc portable&quot;,
        &quot;slug&quot;: &quot;sac-pc-portable&quot;,
        &quot;description&quot;: &quot;Sac &agrave; dos pour Pc portable&quot;,
        &quot;moreDescrciption&quot;: &quot;transpoter votre pc portable en toute s&eacute;curit&eacute;&quot;,
        &quot;additionalInfos&quot;: &quot;&lt;p&gt;sac &agrave; dos&amp;nbsp;&lt;/p&gt;&quot;,
        &quot;stock&quot;: 3,
        &quot;soldePrice&quot;: &quot;12.99&quot;,
        &quot;regularPrice&quot;: &quot;25.00&quot;,
        &quot;imageUrls&quot;: &quot;[\&quot;images\\/6706c8761e825_sac pc portable.jpeg\&quot;]&quot;,
        &quot;brand&quot;: &quot;badday&quot;,
        &quot;isAvailable&quot;: true,
        &quot;isBestSeller&quot;: false,
        &quot;isNewArrival&quot;: true,
        &quot;isFeatured&quot;: false,
        &quot;isSpecialOffer&quot;: false,
        &quot;created_at&quot;: &quot;2024-10-09T18:16:22.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-10-09T18:16:22.000000Z&quot;
    },
    {
        &quot;id&quot;: 22,
        &quot;category_id&quot;: 7,
        &quot;name&quot;: &quot;Gourde &agrave; eau&quot;,
        &quot;slug&quot;: &quot;gourde-a-eau&quot;,
        &quot;description&quot;: &quot;contenant &agrave; eau&quot;,
        &quot;moreDescrciption&quot;: &quot;Contenant&quot;,
        &quot;additionalInfos&quot;: &quot;&lt;p&gt;pour etudiant&amp;nbsp;&lt;/p&gt;&quot;,
        &quot;stock&quot;: 2,
        &quot;soldePrice&quot;: &quot;9.99&quot;,
        &quot;regularPrice&quot;: &quot;19.99&quot;,
        &quot;imageUrls&quot;: &quot;[\&quot;images\\/6706c9d042e71_gourde eau.jpeg\&quot;]&quot;,
        &quot;brand&quot;: &quot;Primark&quot;,
        &quot;isAvailable&quot;: true,
        &quot;isBestSeller&quot;: false,
        &quot;isNewArrival&quot;: true,
        &quot;isFeatured&quot;: false,
        &quot;isSpecialOffer&quot;: false,
        &quot;created_at&quot;: &quot;2024-10-09T18:19:43.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-10-09T18:22:08.000000Z&quot;
    },
    {
        &quot;id&quot;: 23,
        &quot;category_id&quot;: 5,
        &quot;name&quot;: &quot;Toge Etudiants&quot;,
        &quot;slug&quot;: &quot;toge-etudiants&quot;,
        &quot;description&quot;: &quot;Pour votre prochaine remise de diplome&quot;,
        &quot;moreDescrciption&quot;: &quot;f&eacute;licitations jeunes diplom&eacute;s&quot;,
        &quot;additionalInfos&quot;: &quot;&lt;p&gt;Proficiat , Toge mixte pour remise de diplome&amp;nbsp;&lt;/p&gt;&quot;,
        &quot;stock&quot;: 4,
        &quot;soldePrice&quot;: &quot;5.99&quot;,
        &quot;regularPrice&quot;: &quot;25.99&quot;,
        &quot;imageUrls&quot;: &quot;[\&quot;images\\/6706ce69ad2cf_toge etudiant.jpeg\&quot;]&quot;,
        &quot;brand&quot;: &quot;Epfc&quot;,
        &quot;isAvailable&quot;: true,
        &quot;isBestSeller&quot;: true,
        &quot;isNewArrival&quot;: true,
        &quot;isFeatured&quot;: true,
        &quot;isSpecialOffer&quot;: true,
        &quot;created_at&quot;: &quot;2024-10-09T18:41:45.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-10-09T18:41:45.000000Z&quot;
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-products" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-products"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-products"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-products" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-products">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-products" data-method="GET"
      data-path="api/products"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-products', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-products"
                    onclick="tryItOut('GETapi-products');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-products"
                    onclick="cancelTryOut('GETapi-products');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-products"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/products</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-products"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-GETapi-products--id-">GET api/products/{id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-products--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/products/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/products/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-products--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
x-ratelimit-limit: 60
x-ratelimit-remaining: 57
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;category_id&quot;: 1,
    &quot;name&quot;: &quot;Ensemble Gants et Bonnet&quot;,
    &quot;slug&quot;: &quot;ensemble-gants-et-bonnet&quot;,
    &quot;description&quot;: &quot;couvrez vous&quot;,
    &quot;moreDescrciption&quot;: &quot;Restez au chaud &agrave; prix tres abordables ,&quot;,
    &quot;additionalInfos&quot;: &quot;&lt;p&gt;nous pensons aux personnes en situration pr&eacute;caire&amp;nbsp;&lt;/p&gt;&quot;,
    &quot;stock&quot;: 25,
    &quot;soldePrice&quot;: &quot;3.99&quot;,
    &quot;regularPrice&quot;: &quot;15.99&quot;,
    &quot;imageUrls&quot;: &quot;[\&quot;images\\/66e87a590c157_istockphoto-1578054137-612x612.jpg\&quot;]&quot;,
    &quot;brand&quot;: &quot;Zora&quot;,
    &quot;isAvailable&quot;: true,
    &quot;isBestSeller&quot;: true,
    &quot;isNewArrival&quot;: false,
    &quot;isFeatured&quot;: false,
    &quot;isSpecialOffer&quot;: false,
    &quot;created_at&quot;: &quot;2024-09-16T18:35:05.000000Z&quot;,
    &quot;updated_at&quot;: &quot;2024-09-16T18:35:05.000000Z&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-products--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-products--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-products--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-products--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-products--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-products--id-" data-method="GET"
      data-path="api/products/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-products--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-products--id-"
                    onclick="tryItOut('GETapi-products--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-products--id-"
                    onclick="cancelTryOut('GETapi-products--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-products--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/products/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-products--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-products--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-products--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-products--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-products">POST api/products</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-products">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/products" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"adoxt\",
    \"description\": \"Maiores quia reiciendis voluptates perspiciatis.\",
    \"price\": 77009860.311
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/products"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "adoxt",
    "description": "Maiores quia reiciendis voluptates perspiciatis.",
    "price": 77009860.311
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-products">
</span>
<span id="execution-results-POSTapi-products" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-products"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-products"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-products" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-products">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-products" data-method="POST"
      data-path="api/products"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-products', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-products"
                    onclick="tryItOut('POSTapi-products');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-products"
                    onclick="cancelTryOut('POSTapi-products');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-products"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/products</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-products"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-products"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-products"
               value="adoxt"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>adoxt</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-products"
               value="Maiores quia reiciendis voluptates perspiciatis."
               data-component="body">
    <br>
<p>Example: <code>Maiores quia reiciendis voluptates perspiciatis.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="price"                data-endpoint="POSTapi-products"
               value="77009860.311"
               data-component="body">
    <br>
<p>Example: <code>77009860.311</code></p>
        </div>
        </form>

                    <h2 id="endpoints-PUTapi-products--id-">PUT api/products/{id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-products--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/products/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"rgszyxgmytirvf\",
    \"description\": \"Enim possimus perspiciatis est quaerat voluptate.\",
    \"price\": 4977.5024973
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/products/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "rgszyxgmytirvf",
    "description": "Enim possimus perspiciatis est quaerat voluptate.",
    "price": 4977.5024973
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-products--id-">
</span>
<span id="execution-results-PUTapi-products--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-products--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-products--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-products--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-products--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-products--id-" data-method="PUT"
      data-path="api/products/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-products--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-products--id-"
                    onclick="tryItOut('PUTapi-products--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-products--id-"
                    onclick="cancelTryOut('PUTapi-products--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-products--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/products/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-products--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-products--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-products--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-products--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-products--id-"
               value="rgszyxgmytirvf"
               data-component="body">
    <br>
<p>Must not be greater than 255 characters. Example: <code>rgszyxgmytirvf</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="PUTapi-products--id-"
               value="Enim possimus perspiciatis est quaerat voluptate."
               data-component="body">
    <br>
<p>Example: <code>Enim possimus perspiciatis est quaerat voluptate.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>price</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="price"                data-endpoint="PUTapi-products--id-"
               value="4977.5024973"
               data-component="body">
    <br>
<p>Example: <code>4977.5024973</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-products--id-">DELETE api/products/{id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-products--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/products/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/products/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-products--id-">
</span>
<span id="execution-results-DELETEapi-products--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-products--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-products--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-products--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-products--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-products--id-" data-method="DELETE"
      data-path="api/products/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-products--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-products--id-"
                    onclick="tryItOut('DELETEapi-products--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-products--id-"
                    onclick="cancelTryOut('DELETEapi-products--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-products--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/products/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-products--id-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-products--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-products--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-products--id-"
               value="1"
               data-component="url">
    <br>
<p>The ID of the product. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-POSTapi-generate-token">POST api/generate-token</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-generate-token">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/generate-token" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/generate-token"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-generate-token">
</span>
<span id="execution-results-POSTapi-generate-token" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-generate-token"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-generate-token"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-generate-token" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-generate-token">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-generate-token" data-method="POST"
      data-path="api/generate-token"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-generate-token', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-generate-token"
                    onclick="tryItOut('POSTapi-generate-token');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-generate-token"
                    onclick="cancelTryOut('POSTapi-generate-token');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-generate-token"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/generate-token</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-generate-token"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-generate-token"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-generate-token"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
