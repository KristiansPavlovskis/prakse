# Projekta Apraksts

## Mērķis
Izstrādāt pilnībā funkcionalu tīmekļa TODO aplikāciju, kas ļauj lietotājiem reģistrēties, veidot un pārvaldīt personīgos TODO sarakstu grupas, kā arī dalīties ar tiem citiem lietotājiem ar dažādiem piekļuves līmeņiem.

## Tehnoloģijas
- **Back-end:** Laravel (PHP framework)
- **Datu bāze:** MySQL
- **Front-end:** Vue.js
- **Stilizēšana:** TailwindCSS

## Galvenās Prasības un Funkcionalitāte

### Lietotāja Reģistrācija un Autentifikācija
- [ ] Lietotāji var reģistrēties, izmantojot e-pastu un paroli.
- [ ] Lietotāji var pieteikties un iziet no sistēmas.
- [ ] (Papildus) E-pasta apstiprināšana pēc reģistrācijas.

### TODO Sarakstu Grupu Izveide un Pārvaldība
- [ ] Autentificēti lietotāji var izveidot vienu vai vairākas TODO sarakstu grupas.
- [ ] Katrā grupā var izveidot neierobežotu skaitu TODO sarakstu.
- [ ] Lietotāji var labot un dzēst savas grupas un sarakstus.

### TODO Vienumu Pārvaldība
- [ ] Lietotāji var pievienot, labot, dzēst un atzīmēt kā pabeigtus TODO vienumus katrā sarakstā.
- [ ] (Papildus) Iespēja pievienot termiņus vai prioritātes TODO vienumiem.

### Dalīšanās un Pieejas Kontrole
- [ ] Lietotāji var dalīties sarakstiem vai grupām ar citiem lietotājiem, norādot piekļuves līmeni: “lasīt” vai “lasīt un labot”.
- [ ] Ja lietotājs dalās grupu, tad piekļuve tiek piešķirta visiem grupas sarakstiem.
- [ ] (Papildus) Iespēja skatīt un pārvaldīt, ar ko katrs saraksts vai grupa ir kopīgota.

## Tehniskās Prasības

### Laravel
- [ ] Izmantot Laravel autentifikācijas sistēmu.
- [ ] Izmantot Eloquent ORM sarakstu, vienumu un lietotāju datu pārvaldībai.
- [ ] Ievērot MVC (Model-View-Controller) principus.

### MySQL
- [ ] Izstrādāt datu bāzes shēmu TODO aplikācijai, iekļaujot lietotājus, grupas, sarakstus un vienumus.
- [ ] (Papildus) Implementēt piekļuves kontroles tabulas dalīšanās funkcionalitātei.

### Vue.js
- [ ] Izveidot dinamisku un atsaucīgu lietotāja saskarni.
- [ ] Izmantot Vue komponentus atkārtoti izmantojamu saskarnes elementu izstrādei.
- [ ] (Papildus) Izmantot Vuex stāvokļa pārvaldībai.

### TailwindCSS
- [ ] Izmantot TailwindCSS, lai stilizētu saskarni, izmantojot atbildīgu dizainu.
- [ ] (Papildus) Pielāgot dizainu, lai uzlabotu lietotāja pieredzi.

## Piegādes un Testēšana
- [ ] Kodam jābūt augšupielādētam uz GitHub vai citu versiju kontroles sistēmu.
- [ ] Aplikācijai jāiet cauri pamattestēšanai, lai pārliecinātos par tās funkcionalitāti un drošību.
- [ ] (Papildus) Rakstīt vienības un funkcionalitātes testus izmantotajam kodam.

## Dokumentācija
- [ ] Izstrādāt README failu ar instrukcijām par aplikācijas uzstādīšanu, konfigurāciju un lietošanu.
- [ ] Komentēt kodu, lai nodrošinātu tā saprotamību un uzturēšanas iespējas.
