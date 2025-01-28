# Terms of Service

Edit this file to define the terms of service for your application.

# Projecte VideosApp - Autor: Alexander Beltran

## SPRINT 1

### Què s'ha de fer al 1r Sprint?

#### Creació del projecte:
- Crear un nou projecte anomenat **VideosApp + Nom** (per exemple: *VideosAppAlexander*).
- Configurar el projecte amb les següents opcions de Jetstream:
    - `livewire`
    - `phpunit`
    - `teams`
    - `sqlite`

#### Tasques del SPRINT 1:
1. **Test de Helpers:**
    - Crear un test que comprovi:
        - La creació d'un usuari per defecte.
        - La creació d'un professor per defecte.
        - Els camps requerits: `name`, `email`, i `password` (amb encriptació).
        - Associació dels usuaris a un *team*.
2. **Helpers a la carpeta app:**
    - Desenvolupar *helpers* personalitzats a `app/helpers`.
3. **Configuració d'usuaris per defecte:**
    - Afegir credencials dels usuaris al fitxer `.env`.
    - Configurar un fitxer a `config` per gestionar les credencials predeterminades.

---

## SPRINT 2

### Què s'ha de fer al 2n Sprint?

#### Correccions del SPRINT 1:
- Corregir errors identificats durant el primer sprint.
- Al fitxer `phpunit`, descomentar:
    - `db_connection`
    - `db_database`
- Configurar tests per utilitzar una base de dades temporal.

#### Noves funcionalitats:
1. **Migració de vídeos:**
    - Crear la taula de vídeos amb els camps següents:
        - `id`, `title`, `description`, `url`, `published_at`, `previous`, `next`, `series_id`.
    - Afegir URL d'exemple (*links* de YouTube).
2. **Controlador VideosController:**
    - Desenvolupar funcions:
        - `testedBy`
        - `show`
3. **Model de vídeos:**
    - Configurar el camp `published_at` com a data.
    - Implementar funcions de formatació amb Carbon:
        - `getFormattedPublishedAtAttribute`: retorna una data com "13 de gener de 2025".
        - `getFormattedForHumansPublishedAtAttribute`: retorna "fa 2 hores".
        - `getPublishedAtTimestampAttribute`: retorna el valor *Unix timestamp*.
4. **Helpers de vídeos per defecte:**
    - Crear helpers per generar vídeos predeterminats.
5. **DatabaseSeeder:**
    - Afegir usuaris i vídeos predeterminats al *seeder*.
6. **Layout VideosAppLayout:**
    - Crear un layout a:
        - `app/View/components`
        - `resources/views/layouts`
7. **Rutes i vistes:**
    - Crear la ruta i vista per a la funció `show` de vídeos.
8. **Organització de tests:**
    - Moure `HelpersTest` a `tests/Unit`.
    - Afegir tests per comprovar:
        - Creació de vídeos predeterminats.
        - Formatació de dates al model.
        - Visualització de vídeos amb `VideosTest` a:
            - `tests/Unit`
            - `tests/Feature/Videos`
9. **Guia del projecte:**
    - Escriure una guia sobre el projecte i les tasques fetes als dos sprints a `resources/markdown/terms`.
10. **Larastan:**
    - Instal·lar i configurar Larastan.
    - Corregir els errors detectats durant l'anàlisi del codi.
