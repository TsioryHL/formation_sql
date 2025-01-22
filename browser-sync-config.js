const browserSync = require('browser-sync').create();

// Configuration de BrowserSync
browserSync.init({
    proxy: 'http://localhost/formation_sql',  // L'URL de votre projet PHP
    files: ['./**/*.php', './**/*.css', './**/*.js'],  // Surveillez les fichiers PHP, CSS et JS
    reloadDelay: 1000,  // Délai avant de recharger la page (en millisecondes)
    open: false,  // Empêche l'ouverture automatique du navigateur
    notify: false  // Empêche les notifications du navigateur
});

// Redémarre BrowserSync après chaque modification
browserSync.watch(['./**/*.php', './**/*.css', './**/*.js']).on('change', browserSync.reload);
