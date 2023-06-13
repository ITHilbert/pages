# Pages
Mit der Komponente kann ich Pages erstellen, bearbeiten und löschen sowie ausgeben.
Weiterhin gibt es die Möglichkeit eine Sitemap auszugeben entweder für alles oder nach Kategorie.

## Vorraussetzungen 
- Laravelkit

## Installation
```
composer require ithilbert/pages

#Tabelle pages erstellen
php artisan migrate

//Daten kopieren
php artisan vendor:publish --provider="ITHilbert\Pages\PagesServiceProvider" --force
```

### config/app
```
'providers' => ServiceProvider::defaultProviders()->merge([
        /*
         * Package Service Providers...
         */
        ...
        \ITHilbert\Pages\PagesServiceProvider::class,
```

### config/pages.php
Hier können Sie defeinieren wie die Pages Komponente arbeiten soll


## Anmerkungen 
Das anzeigen der Page wird im ITHilbert\Pages\Providers\RoutesServiceProvider.php behandelt.

## ToDo


## Author
IT-Hilbert GmbH

Access, Excel, VBA und Web Programmierungen

Homepage: [IT-Hilbert.com](https://www.IT-Hilbert.com) 
