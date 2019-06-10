Ceci est un fork traduit en français de [mapk/monostack](https://github.com/mapk/monostack).

# Le thème Monostack

Monostack est un thème WordPress prêt pour Gutenberg qui apporte la beauté des éditeurs de code au frontend. Avec un accent fort sur la typographie et la couleur, Monostack met en évidence la grammaire spécifique tout comme la coloration syntaxique faite dans les éditeurs de code. Monostack est nommé d'après les piles de polices "monospace" utilisées dans le thème.

### Fondation

Le thème Monostack est construit sur le [thème de démarrage Gutenberg](https://github.com/WordPress/gutenberg-starter-theme).

### Pile de polices

La pile de polices est là où elle se trouve. J'ai passé beaucoup de temps à réfléchir pour apporter à votre écran les polices de caractères monospaces de la meilleure qualité.

```
body {
    font-family: "Space Mono", "Noto Mono", "Oxygen Mono", Courier, 
    monospace;
}
```

Et pour aller encore plus loin, j’ai aussi un peu travaillé sur le `pre` et le `code`.

```
pre, code {
    font-family: Consolas, "Noto Mono", "Oxygen Mono", 
    Courier, monospace;
}
```
### Coloration syntaxique

Monostack utilise la coloration syntaxique pour extraire certaines grammaires de la langue anglaise ou française.

* Les mots en bleu sont des conjonctions
* Les mots en rose sont des prépositions
* Les mots en vert sont des pronoms

(la version française est moins complète et précise)

![Image of Monostack](https://cldup.com/sNkM_BJyoP.png)
