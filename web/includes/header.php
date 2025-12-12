<?php 

include ("language.php"); 
header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
header("X-Content-Type-Options: nosniff");

?><!DOCTYPE html>
<!--[if IE 9]> 
<html class="no-js ie ie9" lang="nl-NL">
   <![endif]-->
   <!--[if gt IE 9]><!--> 
   <html class="no-js" lang="nl-NL">
      <!--<![endif]-->
      <head>
         <meta charset="UTF-8">
         <link rel="icon" href="assets/favicon-32x32.png">
		   <meta name="viewport" content="width=device-width, initial-scale=1">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <link rel="stylesheet" id="nde-style-css" href="assets/style.20230221.min.css" type="text/css" media="all">
         <link rel="stylesheet" id="site-style-css" href="assets/site.20250509.min.css" type="text/css" media="all">
         <link rel="apple-touch-icon" sizes="180x180" href="assets/apple-touch-icon.png">
         <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon-32x32.png">
         <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon-16x16.png">
         <link rel="manifest" href="assets/site.webmanifest">
         <meta name="msapplication-TileColor" content="#434343">
         <meta name="theme-color" content="#434343">
         <title><?= t('Datasetregister') ?> - <?= t('Voor alle erfgoeddatasets!') ?></title>
         <meta name="description" content="<?= t('Het datasetregister geeft inzicht (voor geïnteresseerden, onderzoekers, andere erfgoedinstellingen en softwareontwikkelaars) in de beschikbaarheid van datasets in het erfgoedveld en stimuleert daarmee het gebruik van deze datasets.') ?>">
		   <meta prefix="og: http://ogp.me/ns#" property="og:site_name" content="<?= t('Datasetregister') ?>">
		   <meta prefix="og: http://ogp.me/ns#" property="og:image" content="https://datasetregister.netwerkdigitaalerfgoed.nl/assets/beeldmerk-social.jpg">
		   <meta prefix="og: http://ogp.me/ns#" property="og:title" content="<?= t('Datasetregister') ?> - <?= t('Voor alle erfgoeddatasets!') ?>">
		   <meta prefix="og: http://ogp.me/ns#" property="og:url" content="https://datasetregister.netwerkdigitaalerfgoed.nl/">
		   <meta prefix="og: http://ogp.me/ns#" property="og:description" content="<?= t('Het datasetregister geeft inzicht (voor geïnteresseerden, onderzoekers, andere erfgoedinstellingen en softwareontwikkelaars) in de beschikbaarheid van datasets in het erfgoedveld en stimuleert daarmee het gebruik van deze datasets.') ?>">
		   <meta property="twitter:card" content="summary">
		   <meta property="twitter:image:src" content="https://datasetregister.netwerkdigitaalerfgoed.nl/assets/beeldmerk-social.jpg">
		   <meta property="twitter:title" content="<?= t('Datasetregister') ?> - <?= t('Voor alle erfgoeddatasets!') ?>">
		   <meta property="twitter:description" content="<?= t('Het datasetregister geeft inzicht (voor geïnteresseerden, onderzoekers, andere erfgoedinstellingen en softwareontwikkelaars) in de beschikbaarheid van datasets in het erfgoedveld en stimuleert daarmee het gebruik van deze datasets.') ?>">
         <meta name="author" content="Netwerk Digitaal Erfgoed">
      </head>
      <body class="<?php if(substr($_SERVER['SCRIPT_FILENAME'],-9,9)=="index.php") { echo "home "; } ?> page-template page-template-t_home page-template-t_home-php page page-id-5 m-theme--blue">
         <svg aria-hidden="true" style="position: absolute; width: 0; height: 0; overflow: hidden;" version="1.1" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink">
            <defs>
               <symbol id="icon-rss" viewBox="0 0 32 32">
                  <path d="M5.333 13.333c-0.736 0-1.333 0.597-1.333 1.333s0.597 1.333 1.333 1.333c5.881 0 10.667 4.785 10.667 10.667 0 0.737 0.597 1.333 1.333 1.333 0.737 0 1.333-0.596 1.333-1.333 0-7.352-5.981-13.333-13.333-13.333z"></path>
                  <path d="M5.333 4c-0.736 0-1.333 0.597-1.333 1.333s0.597 1.333 1.333 1.333c11.028 0 20 8.972 20 20 0 0.737 0.596 1.333 1.333 1.333s1.333-0.596 1.333-1.333c0-12.499-10.168-22.667-22.667-22.667z"></path>
                  <path d="M9.333 25.333c0 1.473-1.194 2.667-2.667 2.667s-2.667-1.194-2.667-2.667c0-1.473 1.194-2.667 2.667-2.667s2.667 1.194 2.667 2.667z"></path>
               </symbol>
               <symbol id="icon-filter" viewBox="0 0 32 32">
                  <path d="M5.333 14.667c0.736 0 1.333-0.597 1.333-1.333v-9.333c0-0.736-0.597-1.333-1.333-1.333s-1.333 0.597-1.333 1.333v9.333c0 0.736 0.597 1.333 1.333 1.333z"></path>
                  <path d="M16 14.667c-0.736 0-1.333 0.597-1.333 1.333v12c0 0.737 0.597 1.333 1.333 1.333 0.737 0 1.333-0.596 1.333-1.333v-12c0-0.736-0.596-1.333-1.333-1.333z"></path>
                  <path d="M26.667 17.333c0.737 0 1.333-0.596 1.333-1.333v-12c0-0.736-0.596-1.333-1.333-1.333s-1.333 0.597-1.333 1.333v12c0 0.737 0.596 1.333 1.333 1.333z"></path>
                  <path d="M9.333 17.333h-8c-0.736 0-1.333 0.596-1.333 1.333s0.597 1.333 1.333 1.333h2.667v8c0 0.737 0.597 1.333 1.333 1.333s1.333-0.596 1.333-1.333v-8h2.667c0.736 0 1.333-0.596 1.333-1.333s-0.597-1.333-1.333-1.333z"></path>
                  <path d="M20 9.333h-2.667v-5.333c0-0.736-0.596-1.333-1.333-1.333-0.736 0-1.333 0.597-1.333 1.333v5.333h-2.667c-0.736 0-1.333 0.597-1.333 1.333s0.597 1.333 1.333 1.333h8c0.737 0 1.333-0.597 1.333-1.333s-0.596-1.333-1.333-1.333z"></path>
                  <path d="M30.667 20h-8c-0.737 0-1.333 0.596-1.333 1.333s0.596 1.333 1.333 1.333h2.667v5.333c0 0.737 0.596 1.333 1.333 1.333s1.333-0.596 1.333-1.333v-5.333h2.667c0.737 0 1.333-0.596 1.333-1.333s-0.596-1.333-1.333-1.333z"></path>
               </symbol>
               <symbol id="icon-phone" viewBox="0 0 32 32">
                  <path d="M27.213 18.532c-1.179-0.156-2.34-0.447-3.451-0.861-1.448-0.543-3.123-0.184-4.227 0.908l-0.956 0.956c-2.459-1.568-4.547-3.656-6.113-6.115l0.961-0.961c1.095-1.107 1.448-2.763 0.901-4.217-0.416-1.113-0.705-2.276-0.863-3.467-0.276-1.963-1.979-3.441-3.987-3.441h-4c-0.119 0-0.237 0.005-0.357 0.016-1.064 0.096-2.027 0.601-2.712 1.421-0.684 0.821-1.008 1.859-0.911 2.944 0.457 4.308 1.944 8.508 4.295 12.133 2.139 3.365 5.047 6.273 8.4 8.404 3.62 2.349 7.8 3.836 12.108 4.304 0.125 0.012 0.251 0.016 0.375 0.016 0.001 0 0.003 0 0.005 0 1.069-0.004 2.072-0.423 2.824-1.183s1.164-1.764 1.16-2.828v-3.967c0.051-2.035-1.429-3.78-3.453-4.063zM28 26.565c0.001 0.357-0.137 0.692-0.387 0.945-0.251 0.252-0.584 0.392-0.941 0.393l-0.101-0.003c-3.875-0.42-7.652-1.764-10.936-3.893-3.035-1.928-5.66-4.553-7.596-7.6-2.128-3.287-3.473-7.081-3.884-10.955-0.032-0.355 0.076-0.7 0.304-0.973 0.228-0.275 0.549-0.443 1.021-0.48h4.027c0.661 0 1.228 0.493 1.319 1.136 0.181 1.377 0.52 2.735 1.007 4.040 0.183 0.485 0.065 1.037-0.295 1.401l-1.693 1.693c-0.424 0.424-0.513 1.080-0.216 1.603 2.016 3.545 4.955 6.484 8.5 8.5 0.517 0.296 1.176 0.208 1.601-0.216l1.688-1.688c0.367-0.361 0.92-0.483 1.411-0.301 1.301 0.487 2.659 0.825 4.028 1.007 0.671 0.093 1.163 0.675 1.145 1.385v4.005z"></path>
               </symbol>
               <symbol id="icon-email" viewBox="0 0 32 32">
                  <path d="M26.667 4h-21.333c-2.205 0-4 1.795-4 4v16c0 2.205 1.795 4 4 4h21.333c2.205 0 4-1.795 4-4v-16c0-2.205-1.795-4-4-4zM5.333 6.667h21.333c0.523 0 0.963 0.308 1.181 0.745l-11.848 8.293-11.848-8.293c0.219-0.437 0.66-0.745 1.181-0.745zM26.667 25.333h-21.333c-0.735 0-1.333-0.597-1.333-1.333v-13.44l11.236 7.865c0.229 0.16 0.496 0.241 0.764 0.241s0.535-0.081 0.764-0.241l11.236-7.865v13.44c0 0.736-0.597 1.333-1.333 1.333z"></path>
               </symbol>
               <symbol id="icon-download" viewBox="0 0 24 24">
                  <path d="M20 15v4c0 0.276-0.111 0.525-0.293 0.707s-0.431 0.293-0.707 0.293h-14c-0.276 0-0.525-0.111-0.707-0.293s-0.293-0.431-0.293-0.707v-4c0-0.552-0.448-1-1-1s-1 0.448-1 1v4c0 0.828 0.337 1.58 0.879 2.121s1.293 0.879 2.121 0.879h14c0.828 0 1.58-0.337 2.121-0.879s0.879-1.293 0.879-2.121v-4c0-0.552-0.448-1-1-1s-1 0.448-1 1zM13 12.586v-9.586c0-0.552-0.448-1-1-1s-1 0.448-1 1v9.586l-3.293-3.293c-0.391-0.391-1.024-0.391-1.414 0s-0.391 1.024 0 1.414l5 5c0.092 0.092 0.202 0.166 0.324 0.217s0.253 0.076 0.383 0.076c0.256 0 0.512-0.098 0.707-0.293l5-5c0.391-0.391 0.391-1.024 0-1.414s-1.024-0.391-1.414 0z"></path>
               </symbol>
               <symbol id="icon-linkedin" viewBox="0 0 32 32">
                  <path d="M12 12h5.535v2.837h0.079c0.77-1.381 2.655-2.837 5.464-2.837 5.842 0 6.922 3.637 6.922 8.367v9.633h-5.769v-8.54c0-2.037-0.042-4.657-3.001-4.657-3.005 0-3.463 2.218-3.463 4.509v8.688h-5.767v-18z"></path>
                  <path d="M2 12h6v18h-6v-18z"></path>
                  <path d="M8 7c0 1.657-1.343 3-3 3s-3-1.343-3-3c0-1.657 1.343-3 3-3s3 1.343 3 3z"></path>
               </symbol>
               <symbol id="icon-twitter" viewBox="0 0 32 32">
                  <path d="M32 7.075c-1.175 0.525-2.444 0.875-3.769 1.031 1.356-0.813 2.394-2.1 2.887-3.631-1.269 0.75-2.675 1.3-4.169 1.594-1.2-1.275-2.906-2.069-4.794-2.069-3.625 0-6.563 2.938-6.563 6.563 0 0.512 0.056 1.012 0.169 1.494-5.456-0.275-10.294-2.888-13.531-6.862-0.563 0.969-0.887 2.1-0.887 3.3 0 2.275 1.156 4.287 2.919 5.463-1.075-0.031-2.087-0.331-2.975-0.819 0 0.025 0 0.056 0 0.081 0 3.181 2.263 5.838 5.269 6.437-0.55 0.15-1.131 0.231-1.731 0.231-0.425 0-0.831-0.044-1.237-0.119 0.838 2.606 3.263 4.506 6.131 4.563-2.25 1.762-5.075 2.813-8.156 2.813-0.531 0-1.050-0.031-1.569-0.094 2.913 1.869 6.362 2.95 10.069 2.95 12.075 0 18.681-10.006 18.681-18.681 0-0.287-0.006-0.569-0.019-0.85 1.281-0.919 2.394-2.075 3.275-3.394z"></path>
               </symbol>
               <symbol id="icon-youtube" viewBox="0 0 32 32">
                  <path d="M31.681 9.6c0 0-0.313-2.206-1.275-3.175-1.219-1.275-2.581-1.281-3.206-1.356-4.475-0.325-11.194-0.325-11.194-0.325h-0.012c0 0-6.719 0-11.194 0.325-0.625 0.075-1.987 0.081-3.206 1.356-0.963 0.969-1.269 3.175-1.269 3.175s-0.319 2.588-0.319 5.181v2.425c0 2.587 0.319 5.181 0.319 5.181s0.313 2.206 1.269 3.175c1.219 1.275 2.819 1.231 3.531 1.369 2.563 0.244 10.881 0.319 10.881 0.319s6.725-0.012 11.2-0.331c0.625-0.075 1.988-0.081 3.206-1.356 0.962-0.969 1.275-3.175 1.275-3.175s0.319-2.587 0.319-5.181v-2.425c-0.006-2.588-0.325-5.181-0.325-5.181zM12.694 20.15v-8.994l8.644 4.513-8.644 4.481z"></path>
               </symbol>
               <symbol id="icon-instagram" viewBox="0 0 32 32">
                  <path d="M22.667 1.333h-13.333c-4.412 0-8 3.588-8 8v13.333c0 4.412 3.588 8 8 8h13.333c4.412 0 8-3.588 8-8v-13.333c0-4.412-3.588-8-8-8zM28 22.667c0 2.941-2.392 5.333-5.333 5.333h-13.333c-2.941 0-5.333-2.392-5.333-5.333v-13.333c0-2.941 2.392-5.333 5.333-5.333h13.333c2.941 0 5.333 2.392 5.333 5.333v13.333z"></path>
                  <path d="M17.035 9.348c-0.648-0.096-1.305-0.096-1.956 0-3.636 0.54-6.155 3.936-5.616 7.572 0.481 3.245 3.315 5.692 6.589 5.692 0.324 0 0.652-0.025 0.983-0.073 1.761-0.261 3.316-1.193 4.377-2.624 1.060-1.431 1.501-3.189 1.24-4.949-0.432-2.927-2.689-5.184-5.617-5.617zM19.271 18.325c-0.637 0.859-1.571 1.417-2.627 1.575-2.192 0.333-4.225-1.231-4.544-3.371-0.324-2.181 1.189-4.22 3.369-4.543 0.195-0.028 0.391-0.043 0.587-0.043s0.392 0.015 0.587 0.043c1.756 0.26 3.111 1.615 3.369 3.371 0.16 1.055-0.104 2.111-0.741 2.968z"></path>
                  <path d="M23.347 7.333h-0.013c-0.737 0-1.327 0.597-1.327 1.333s0.603 1.333 1.34 1.333 1.333-0.597 1.333-1.333-0.597-1.333-1.333-1.333z"></path>
               </symbol>
               <symbol id="icon-envelope-o" viewBox="0 0 28 28">
                  <path d="M26 23.5v-12c-0.328 0.375-0.688 0.719-1.078 1.031-2.234 1.719-4.484 3.469-6.656 5.281-1.172 0.984-2.625 2.188-4.25 2.188h-0.031c-1.625 0-3.078-1.203-4.25-2.188-2.172-1.813-4.422-3.563-6.656-5.281-0.391-0.313-0.75-0.656-1.078-1.031v12c0 0.266 0.234 0.5 0.5 0.5h23c0.266 0 0.5-0.234 0.5-0.5zM26 7.078c0-0.391 0.094-1.078-0.5-1.078h-23c-0.266 0-0.5 0.234-0.5 0.5 0 1.781 0.891 3.328 2.297 4.438 2.094 1.641 4.188 3.297 6.266 4.953 0.828 0.672 2.328 2.109 3.422 2.109h0.031c1.094 0 2.594-1.437 3.422-2.109 2.078-1.656 4.172-3.313 6.266-4.953 1.016-0.797 2.297-2.531 2.297-3.859zM28 6.5v17c0 1.375-1.125 2.5-2.5 2.5h-23c-1.375 0-2.5-1.125-2.5-2.5v-17c0-1.375 1.125-2.5 2.5-2.5h23c1.375 0 2.5 1.125 2.5 2.5z"></path>
               </symbol>
               <symbol id="icon-arrow-down" viewBox="0 0 24 24">
                  <path d="M7.406 8.578l4.594 4.594 4.594-4.594 1.406 1.406-6 6-6-6z"></path>
               </symbol>
               <symbol id="icon-search" viewBox="0 0 32 32">
                  <path d="M28.943 27.057l-4.909-4.909c1.644-2.053 2.633-4.652 2.633-7.481 0-6.616-5.383-12-12-12-6.616 0-12 5.384-12 12 0 6.617 5.384 12 12 12 2.829 0 5.428-0.989 7.481-2.633l4.909 4.909c0.26 0.26 0.601 0.391 0.943 0.391s0.683-0.131 0.943-0.391c0.521-0.521 0.521-1.364 0-1.885zM5.333 14.667c0-5.147 4.187-9.333 9.333-9.333 5.145 0 9.333 4.187 9.333 9.333 0 2.563-1.039 4.885-2.717 6.575-0.008 0.008-0.017 0.009-0.025 0.017s-0.009 0.017-0.017 0.025c-1.688 1.677-4.011 2.716-6.573 2.716-5.147 0-9.333-4.188-9.333-9.333z"></path>
               </symbol>
               <symbol id="icon-arrow-right" viewBox="0 0 27.179 14.737">
                  <path d="M14.053,6,13.021,7.032l5.526,5.6-24.306.1V14.2l24.306-.1-5.526,5.6,1.032,1.032,7.369-7.369Z" transform="translate(5.758 -6)"/>
               </symbol>
               <symbol id="icon-arrow-left" viewBox="0 0 24 24">
                  <path d="M15.422 16.594l-1.406 1.406-6-6 6-6 1.406 1.406-4.594 4.594z"></path>
               </symbol>
               <symbol id="icon-map-pin" viewBox="0 0 32 32">
                  <path d="M16 0c-7.352 0-13.333 5.981-13.333 13.333 0 9.932 12.080 18.1 12.593 18.443 0.224 0.148 0.483 0.224 0.74 0.224s0.516-0.076 0.74-0.224c0.512-0.343 12.593-8.511 12.593-18.443 0-7.352-5.981-13.333-13.333-13.333zM16 29.028c-2.529-1.877-10.667-8.477-10.667-15.695 0-5.881 4.785-10.667 10.667-10.667s10.667 4.785 10.667 10.667c0 7.217-8.139 13.817-10.667 15.695z"></path>
                  <path d="M16 8c-2.941 0-5.333 2.392-5.333 5.333s2.392 5.333 5.333 5.333 5.333-2.392 5.333-5.333-2.392-5.333-5.333-5.333zM16 16c-1.471 0-2.667-1.196-2.667-2.667s1.196-2.667 2.667-2.667c1.472 0 2.667 1.196 2.667 2.667s-1.195 2.667-2.667 2.667z"></path>
               </symbol>
               <symbol id="icon-close" viewBox="0 0 20 20">
                  <path d="M10 8.586l-7.071-7.071-1.414 1.414 7.071 7.071-7.071 7.071 1.414 1.414 7.071-7.071 7.071 7.071 1.414-1.414-7.071-7.071 7.071-7.071-1.414-1.414-7.071 7.071z"></path>
               </symbol>
               <symbol id="icon-external-link" viewBox="0 0 32 32">
                  <path d="M24 16c-0.737 0-1.333 0.597-1.333 1.333v8c0 0.736-0.597 1.333-1.333 1.333h-14.667c-0.735 0-1.333-0.597-1.333-1.333v-14.667c0-0.735 0.599-1.333 1.333-1.333h8c0.736 0 1.333-0.597 1.333-1.333s-0.597-1.333-1.333-1.333h-8c-2.205 0-4 1.795-4 4v14.667c0 2.205 1.795 4 4 4h14.667c2.205 0 4-1.795 4-4v-8c0-0.736-0.596-1.333-1.333-1.333z"></path>
                  <path d="M29.231 3.491c-0.136-0.327-0.395-0.585-0.721-0.721-0.163-0.068-0.336-0.103-0.509-0.103h-8c-0.737 0-1.333 0.597-1.333 1.333s0.596 1.333 1.333 1.333h4.781l-12.391 12.391c-0.521 0.521-0.521 1.364 0 1.885 0.26 0.26 0.601 0.391 0.943 0.391s0.683-0.131 0.943-0.391l12.391-12.391v4.781c0 0.736 0.596 1.333 1.333 1.333s1.333-0.597 1.333-1.333v-8c0-0.173-0.035-0.347-0.103-0.509z"></path>
               </symbol>
               <symbol id="icon-github" viewBox="0 0 32 32">
                  <path d="M30 11.36c0-1.943-0.647-3.8-1.839-5.308 0.46-1.739 0.327-3.572-0.389-5.244-0.156-0.364-0.467-0.64-0.847-0.752-0.491-0.147-2.305-0.417-5.831 1.815-2.909-0.691-5.947-0.691-8.857 0-3.528-2.233-5.347-1.96-5.831-1.815-0.379 0.112-0.689 0.388-0.845 0.752-0.717 1.671-0.848 3.505-0.391 5.244-1.2 1.521-1.848 3.393-1.837 5.348 0 7.151 3.972 9.453 7.729 10.309-0.316 0.791-0.456 1.637-0.396 2.464v0.128c-2.783 0.581-3.689-0.567-4.804-1.983-0.717-0.911-1.529-1.943-2.872-2.277-0.709-0.18-1.439 0.253-1.617 0.971-0.179 0.713 0.256 1.437 0.971 1.616 0.459 0.115 0.907 0.684 1.424 1.341 1.172 1.487 2.875 3.645 6.899 3.035v2.329c0 0.737 0.597 1.333 1.333 1.333s1.333-0.596 1.333-1.333l-0.003-3.915c0.004-0.057 0.004-0.115 0-0.173v-1.167c-0.063-0.893 0.259-1.776 0.881-2.419 0.352-0.363 0.468-0.893 0.3-1.371-0.168-0.476-0.591-0.816-1.093-0.879-3.853-0.479-7.419-1.78-7.419-8.019-0.008-1.539 0.572-3 1.632-4.113 0.352-0.369 0.463-0.907 0.284-1.385-0.385-1.032-0.447-2.137-0.188-3.188 0.653 0.143 1.807 0.553 3.529 1.708 0.32 0.216 0.717 0.279 1.091 0.18 2.824-0.765 5.811-0.765 8.636 0 0.371 0.1 0.771 0.036 1.091-0.18 1.74-1.165 2.9-1.573 3.528-1.717 0.261 1.053 0.2 2.163-0.185 3.197-0.179 0.477-0.069 1.016 0.283 1.385 1.053 1.107 1.633 2.555 1.633 4.081 0 6.313-3.557 7.58-7.4 8.007-0.505 0.057-0.935 0.396-1.107 0.873-0.173 0.479-0.057 1.013 0.296 1.379 0.632 0.652 0.953 1.545 0.877 2.553v5.161c0 0.737 0.596 1.333 1.333 1.333s1.333-0.596 1.333-1.333l-0.004-5.055c0.071-0.887-0.065-1.767-0.381-2.577 3.12-0.677 7.719-2.775 7.719-10.341z"></path>
               </symbol>
               <symbol id="icon-chevron-down" viewBox="0 0 24 24">
                  <path d="M5.293 9.707l6 6c0.391 0.391 1.024 0.391 1.414 0l6-6c0.391-0.391 0.391-1.024 0-1.414s-1.024-0.391-1.414 0l-5.293 5.293-5.293-5.293c-0.391-0.391-1.024-0.391-1.414 0s-0.391 1.024 0 1.414z"></path>
               </symbol>
            </defs>
         </svg>
         <header id="header" class="c-site-header">
            <div class="o-container">
               <nav class="desktop">
                  <div class="menu-holder">
                     <a href="/<?= l() ?>" class="logo m-select--none" aria-label="<?= t('Naar de startpagina van het Datasetregister') ?>" style="width:400px;margin-top:12px">
						<svg viewBox="0 0 266 38" xmlns="http://www.w3.org/2000/svg"> <defs> <style>.st0{fill:currentColor}</style> </defs> <path transform="matrix(0.707094, -0.707119, 0.707119, 0.707094, -11.695065, 28.198312)" class="st0" d="M26.89 22.35h2.61v11.73h-2.61z"/> <path transform="matrix(0.707094, -0.707119, 0.707119, 0.707094, -3.999806, 9.619853)" class="st0" d="M8.31 3.77h2.61V15.5H8.31z"/> <path transform="matrix(0.382812, -0.923826, 0.923826, 0.382812, 8.495902, 26.296938)" class="st0" d="M18.06 5.49h11.73V8.1H18.06z"/> <path transform="matrix(0.382812, -0.923826, 0.923826, 0.382812, -20.135798, 31.990094)" class="st0" d="M8.01 29.76h11.73v2.61H8.01z"/> <path class="st0" d="M17.6 26.2h2.61v11.73H17.6zM17.6-.08h2.61v11.73H17.6z"/> <path transform="matrix(0.92388, -0.382683, 0.382683, 0.92388, -10.065885, 11.521379)" class="st0" d="M22.62 25.2h2.61v11.73h-2.61z"/> <path transform="matrix(0.92388, -0.382683, 0.382683, 0.92388, -1.542401, 5.825825)" class="st0" d="M12.57.92h2.61v11.73h-2.61z"/> <path transform="matrix(0.382683, -0.92388, 0.92388, 0.382683, -8.666396, 14.829821)" class="st0" d="M5.46 8.03h2.61v11.73H5.46z"/> <path transform="matrix(0.92388, -0.382683, 0.382683, 0.92388, -2.956749, 12.935421)" class="st0" d="M25.17 12.6H36.9v2.61H25.17z"/> <path transform="matrix(0.92388, -0.382683, 0.382683, 0.92388, -8.651537, 4.411784)" class="st0" d="M.9 22.65h11.73v2.61H.9z"/> <path transform="matrix(0.707094, -0.707119, 0.707119, 0.707094, 1.4415, 22.756004)" class="st0" d="M22.32 8.33h11.73v2.61H22.32z"/> <path transform="matrix(0.707094, -0.707119, 0.707119, 0.707094, -17.136665, 15.061452)" class="st0" d="M3.75 26.91h11.73v2.61H3.75z"/> <text class="st0" style="font-family: Poppins,Helvetica,Arial,sans-serif;font-size: 27px; font-weight:400;" x="41" y="26">datasetregister</text> <rect x="-0.039" y="17.751" width="43.395" height="2.414" class="st0"/></svg>
                     </a>
                     <ul class="main">
                        <li><a class="<?php if(strstr($_SERVER['REQUEST_URI'],"maak.php")) { echo "active "; } ?>m-theme-before m-select--none" href="maak.php<?= l() ?>"><?= t('Maak') ?></a>
                        </li>
                        <li>
                           <a class="<?php if(strstr($_SERVER['REQUEST_URI'],"validate.php")) { echo "active "; } ?>m-theme-before m-select--none" href="validate.php<?= l() ?>"><?= t('Valideer') ?></a>
                        </li>
                        <li>
                           <a class="<?php if(strstr($_SERVER['REQUEST_URI'],"viaurl.php")) { echo "active "; } ?>m-theme-before m-select--none" href="viaurl.php<?= l() ?>"><?= t('Meld aan') ?></a>
                        </li>
						<li>
                           <a class="m-theme-before m-select--none" href="<?= languagePrefix() ?>/datasets"><?= t('Doorzoek') ?></a>
                        </li>
                        <li class="has-sub" arial-label="Open submenu" title="Open submenu">
                           <a class="<?php if(strstr($_SERVER['REQUEST_URI'],"faq")) { echo "active "; } ?>m-theme-before m-select--none" href="faq.php<?= l() ?>"><?= t('Veel gestelde vragen') ?></a>
                           <nav>
                              <ul class="submenu">
                                 <li>
                                    <a href="faq-beheerders.php<?= l() ?>"><?= t('datasetbeheerders bij erfgoed&shy;instellingen') ?></a>
                                 </li>
                                 <li>
                                    <a href="faq-gebruikers.php<?= l() ?>"><?= t('datasetgebruikers bij erfgoed&shy;instellingen en aggregators') ?></a>
                                 </li>
                                 <li>
                                    <a href="faq-ontwikkelaars.php<?= l() ?>"><?= t('ontwikkelaars van erfgoed software') ?></a>
                                 </li>
                                 <li>
                                    <a href="faq-developers.php<?= l() ?>"><?= t('ontwikkelaars die erfgoed datasets willen vinden') ?></a>
                                 </li>
                              </ul>
                           </nav>
                        </li>
                        <?php if (isset($_GET["lang"]) && $_GET["lang"]=="en") { ?>
                           <li><a title="Schakel naar de Nederlandse versie" href="<?= parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);?>?lang=nl<?php if(isset($_GET["uri"])) { echo "?uri=".urlencode($_GET["uri"]); } ?>">NL &#x2022; <strong>EN</strong></a></li>
                        <?php } else { ?>						
                           <li><a title="Switch to the English version" href="<?= parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH); ?>?lang=en<?php if(isset($_GET["uri"])) { echo "&uri=".urlencode($_GET["uri"]); } ?>"><strong>NL</strong> &#x2022; EN</a></li>
                        <?php } ?>
                     </ul>
                  </div>
               </nav>
               <div class="mobile-controls cf">
                  <a href="/<?= l() ?>" class="logo m-select--none" aria-label="nde-logo" aria-labelledby="header" role="none" style="width:240px;margin-top:16px;margin-right:0">
                     <svg viewBox="0 0 266 38" xmlns="http://www.w3.org/2000/svg"> <defs> <style>.st0{fill:currentColor}</style> </defs> <path transform="matrix(0.707094, -0.707119, 0.707119, 0.707094, -11.695065, 28.198312)" class="st0" d="M26.89 22.35h2.61v11.73h-2.61z"/> <path transform="matrix(0.707094, -0.707119, 0.707119, 0.707094, -3.999806, 9.619853)" class="st0" d="M8.31 3.77h2.61V15.5H8.31z"/> <path transform="matrix(0.382812, -0.923826, 0.923826, 0.382812, 8.495902, 26.296938)" class="st0" d="M18.06 5.49h11.73V8.1H18.06z"/> <path transform="matrix(0.382812, -0.923826, 0.923826, 0.382812, -20.135798, 31.990094)" class="st0" d="M8.01 29.76h11.73v2.61H8.01z"/> <path class="st0" d="M17.6 26.2h2.61v11.73H17.6zM17.6-.08h2.61v11.73H17.6z"/> <path transform="matrix(0.92388, -0.382683, 0.382683, 0.92388, -10.065885, 11.521379)" class="st0" d="M22.62 25.2h2.61v11.73h-2.61z"/> <path transform="matrix(0.92388, -0.382683, 0.382683, 0.92388, -1.542401, 5.825825)" class="st0" d="M12.57.92h2.61v11.73h-2.61z"/> <path transform="matrix(0.382683, -0.92388, 0.92388, 0.382683, -8.666396, 14.829821)" class="st0" d="M5.46 8.03h2.61v11.73H5.46z"/> <path transform="matrix(0.92388, -0.382683, 0.382683, 0.92388, -2.956749, 12.935421)" class="st0" d="M25.17 12.6H36.9v2.61H25.17z"/> <path transform="matrix(0.92388, -0.382683, 0.382683, 0.92388, -8.651537, 4.411784)" class="st0" d="M.9 22.65h11.73v2.61H.9z"/> <path transform="matrix(0.707094, -0.707119, 0.707119, 0.707094, 1.4415, 22.756004)" class="st0" d="M22.32 8.33h11.73v2.61H22.32z"/> <path transform="matrix(0.707094, -0.707119, 0.707119, 0.707094, -17.136665, 15.061452)" class="st0" d="M3.75 26.91h11.73v2.61H3.75z"/> <text class="st0" style="font-family: Poppins,Helvetica,Arial,sans-serif;font-size: 27px; font-weight:400;" x="41" y="26">datasetregister</text> <rect x="-0.039" y="17.751" width="43.395" height="2.414" class="st0"/></svg>
                  </a>
                  <div class="menu-toggler m-select--none">
                     <span><?= t('Sluiten') ?></span>
                     <div class="bar"></div>
                     <div class="bar"></div>
                     <div class="bar"></div>
                  </div>
               </div>
            </div>
            <nav class="mobile">
               <div class="menu-holder o-container m-text-align--left">
				  <ul class="main">
					<li>
					   <a class="m-theme-before m-select--none" href="/<?= l() ?>">Home</a>
					</li>
					<li>
					   <a class="m-theme-before m-select--none" href="maak.php<?= l() ?>"><?= t('Maak') ?></a>
					</li>
					<li>
					   <a class="m-theme-before m-select--none" href="validate.php<?= l() ?>"><?= t('Valideer') ?></a>
					</li>
					<li>
					   <a class="m-theme-before m-select--none" href="viaurl.php<?= l() ?>"><?= t('Meld aan') ?></a>
					</li>
					<li>
					   <a class="m-theme-before m-select--none" href="<?= languagePrefix() ?>/datasets"><?= t('Doorzoek') ?></a>
					</li>
					<li>
					   <a class="m-theme-before m-select--none" href="faq.php<?= l() ?>"><?= t('Veel gestelde vragen') ?></a>
					</li>
               <li><?php if (isset($_GET["lang"]) && $_GET["lang"]=="en") { ?>
                           <li><a href="<?= parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH); ?><?php if(isset($_GET["uri"])) { echo "?uri=".urlencode($_GET["uri"]); } ?>">Schakel naar de<br><strong>Nederlandse</strong> versie</a>
                        <?php } else { ?>
                           <li><a href="<?= parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH); ?>?lang=en<?php if(isset($_GET["uri"])) { echo "&uri=".urlencode($_GET["uri"]); } ?>">Switch to the<br><strong>English</strong> version</a></li>
                        <?php } ?></li>
				 </ul>
               </div>
            </nav>
         </header>
