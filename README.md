# Pages

Mit der Komponente kann ich Artikel erstellen, bearbeiten und löschen und ausgeben.


## Installation
```
cd packages
git clone https://github.com/ITHilbert/Site.git
```

### Composer
```
"autoload": {
     "psr-4": {
         "App\\": "app/",
         "ITHilbert\\": "packages/",
         "ITHilbert\\Site\\": "packages/site/src/"
     }
},
```

### config/app.php
Den Punkt Providers um folgenden Eintrag ergänzen:
```
\ITHilbert\Site\SiteServiceProvider::class,
```

### Git löschen
```
cd packages/site
rm -Rf .git
```

### ToDo


### Author
IT-Hilbert GmbH

Access, Excel, VBA und Web Programmierungen

Homepage: [IT-Hilbert.com](https://www.IT-Hilbert.com) 
