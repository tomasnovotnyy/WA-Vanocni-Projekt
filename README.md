# WA-Vanocni-Projekt
# *Název - ChatZone*

# *Popis webové stránky*
> *ChatZone je webová aplikace navržená pro chatování a registraci uživatelů. Umožňuje uživatelům zaregistrovat se, přihlásit se a komunikovat s ostatními uživateli.*

# *Funkce webové stránky*
> - Přihlášení a registrace - Uživatelé mohou vytvořit účet pomocí svého emailu a hesla nebo se přihlásit pomocí již existujících údajů.
> - Pouze autentizované uživatele mají přístup k aplikaci.
> - Kontroluji zda nenastane kolize uživatelských jmen (emailů).
> - Hashování hesel.
> - Chatování - Po přihlášení mohou uživatelé začít chatovat.
> - Footer s informacemi pro uživatele.
> - Login page sloužící pro přihlášení nebo registraci.
> - Local storage, do které se ukládájí informace o přihlášeném uživateli.

# *index.php*
## *Popis*
- Tento soubor představuje stránku mé webové aplikace s názvem "ChatZone".
- Stránka obsahuje formuláře pro přihlášení a registraci uživatele.
- Součástí jsou také navigační lišta a footer stránky.
- Stránka obsahuje navigační lištu s logem a názvem "ChatZone".
- Dále jsou k dispozici dvě karty - jedna pro přihlášení a druhá pro registraci. Každý formulář obsahuje pole pro zadání e-mailu a hesla, a tlačítko pro odeslání formuláře.
- Při přihlášení nebo registraci jsou data odesílána na odpovídající PHP skripty (login/logme.php a login/registerme.php).
- Ukládání přihlašovacích údajů:
  - Stránka obsahuje skript saveCredentials(), který ukládá přihlašovací údaje do lokálního úložiště pro případné pozdější použití. Tento skript je volán při kliknutí na tlačítko "Login" nebo "Register".

</br></br>

# *chat.php*
## *Popis*
Tento soubor představuje chatovací stránku mé webové aplikace "ChatZone". Stránka umožňuje uživateli komunikovat v reálném čase s druhým uživatelem prostřednictvím dvou chatovacích oken.
</br>
Stránka obsahuje:
- Navigační lištu:
  - Navigační lišta obsahuje logo "ChatZone" a tlačítko pro přihlášení nebo odhlášení v závislosti na stavu uživatelské session.
  - Dva chatovací kontejnery: Každý z nich má oddělený vstupní formulář a tlačítko pro odeslání zprávy.
  - JavaScript funkce pro odesílání zpráv: Skript umožňuje uživateli psát zprávy a odesílat je do svého chatovacího okna a také automaticky odesílat kopii zprávy do chatovacího okna druhého uživatele.
  - Chybové kontroly: Před odesláním zprávy jsou provedeny kontrola na prázdný text zprávy a zpráva je odeslána pouze v případě, že není prázdná.

## *Funkce*
- sendMessage(chatId): Odešle zprávu od uživatele do chatu s ID chatId.
- sendMessageToOtherChat(currentChatId, message): Odešle kopii zprávy do druhého chatu.

</br></br>

# *api.php*
## *Popis*
Tento PHP soubor slouží jako API controller pro mou webovou aplikaci "ChatZone". Implementuje základní funkce pro získání dat z databáze pomocí HTTP GET požadavků a zpracování JWT pro autentizaci.
</br>
- Načtení knihoven: Využívá knihovnu pro práci s JWT - Firebase PHP JWT.
- Definice tajného klíče: Určuje tajný klíč pro JWT.
- Připojení k databázi: Vytváří připojení k databázi pomocí PDO.
- Získání metody HTTP požadavku: Identifikuje metodu (GET) HTTP požadavku.
- Získání cesty požadavku: Extrahuje cestu požadavku a zpracovává ji.
- Dekódování těla požadavku: Získává a dekóduje tělo požadavku v JSON formátu.
- Zpracování GET požadavků: V závislosti na prvním parametru v cestě (messages, chatrooms, search) provede odpovídající operace nad databází.

## *Poznámky*
- Neimplementovaná funkcionalita:
  - Bohužel se mi nepodařilo tento soubor implementovat do mé webové aplikace. Pokusil jsem se vytvořit funkcionalitu pro získání zpráv podle zadaných kritérií, ale soubor jsem nakonec ve finální verzi aplikace nepoužil.

</br></br>

# *registerme.php*
## *Popis*
Tento soubor slouží jako backendový skript pro zpracování registrace uživatelů v mé webové aplikaci "ChatZone". Po načtení pomocí POST metody z formuláře odesílajícího registraci, provede základní kontrolu, zda soubor s uživatelskými daty existuje, a následně zpracuje a zapisuje nové uživatelské údaje do souboru ve formátu JSON.
</br>
- get_data():
  - Funkce získává data z formuláře registrace a provádí základní kontrolu na unikátnost e-mailu. Pokud e-mail již existuje, funkce vrátí false, jinak vrátí nová data ve formátu JSON.
- Kontrola POST metody:
  - Skript zjišťuje, zda byl načten pomocí POST metody.
- Získání e-mailu:
  - Získává e-mail z POST dat.
- Zpracování dat:
  - Získává a zpracovává data pomocí funkce get_data().
- Zápis do souboru:
  - Pokud jsou data úspěšně získána, skript je zapisuje do souboru 'data.json'. V případě úspěchu spouští session, ukládá e-mail do session a přesměrovává uživatele na index.php.
- Hashování hesla:
  - Skript hashuje uživatelské heslo pomocí defaultní metody.
- Kontrola existence souboru:
  - Kontroluje, zda soubor 'data.json' existuje. Pokud neexistuje, vytvoří nový s prvním uživatelem.
- Chybové zprávy:
  - Poskytuje odpovídající chybové zprávy v případě neúspěšného získání dat nebo zápisu do souboru.

</br></br>

# *logme.php*
## *Popis*
Tento soubor slouží jako backendový skript pro zpracování přihlášení uživatelů v mé webové aplikaci "ChatZone". Po načtení pomocí POST metody z formuláře odesílajícího přihlášení, provede kontrolu údajů vůči existujícím datům uživatelů v souboru 'data.json'.
</br>
- Kontrola POST metody:
  - Skript zjišťuje, zda byl načten pomocí POST metody.
- Získání e-mailu a hesla:
  - Získává e-mail a heslo z POST dat.
- Inicializace proměnných:
  - Inicializuje proměnné pro kontrolu úspěšnosti přihlášení a viditelnost e-mailu.
- Název souboru s daty:
  - Určuje název souboru, ze kterého se budou načítat data.
- Načtení aktuálních dat:
  - Načítá aktuální data ze souboru 'data.json'.
- Převedení dat:
  - Převede data z JSON formátu do pole.
- Procházení pole s daty:
  - Prochází pole s daty a kontroluje shodu e-mailu a hesla.
- Kontrola e-mailu:
  - Kontroluje, zda se e-mail nachází v datech a není prázdný.
- Kontrola hesla:
  - Kontroluje, zda heslo odpovídá hashi v datech a není prázdné.
- Zahájení session:
  - V případě úspěšného přihlášení zahájí session a uloží e-mail do session.
- Přesměrování:
  - Přesměruje uživatele na chat.php v případě úspěšného přihlášení, jinak na index.php.

</br></br>

# *logout.php*
## *Popis*
Tento kód je částí webové aplikace a slouží k ukončení uživatelské session a přesměrování na úvodní stránku aplikace.
</br>
- session_start(): Zahájí novou nebo obnoví existující session.
- session_destroy(): Zničí všechna data uložená v aktuální session.
- header("Location: index.php"): Přesměruje uživatele na index.php. Ujistěte se, že soubor index.php existuje a obsahuje požadovaný obsah.
- exit(): Ukončí běh skriptu, aby se zabránilo dalším operacím po přesměrování.

# *Použité technologie*
> - HTML5
> - CSS3 (Bootstrap framework)
> - JavaScript
> - Bootstrap 5
> - Font Awesome pro ikony

# *Jak nainstalovat a spustit*
> - Pro spuštění je za potřebí mít nainstalovaný XAMPP Control Panel -> následně spustíme Apache
> - Místo pro umístění záleží na jekém PC pracujete, ale např. na mém PC mám vše potřebné ve složce *htdocs*, kde je nainstalovaný XAMPP

# *Důvod použití XAMPP*
> - Pro lokalní vývoj a testování této aplikace doporučuji použití XAMPP. Hlavním důvodem je, že při konfiguraci Amazon Web Services (AWS) se mi nepodařilo úspěšně nasadit a nakonfigurovat aplikaci.

# *Hardware & Software*
<details>
<summary>Hardware</summary>
Název zařízení: MSI<br/>
Procesor: 11th Gen Intel(R) Core(TM) i7-11800H @ 2.30GHz 2.30 GHz<br/>
Nainstalovaná paměť RAM: 16,0 GB (použitelné: 15,7 GB)<br/>
Typ systému: 64bitový operační systém, procesor pro platformu x64<br/>
Edice: Windows 11 Home Single Language<br/>
Verze: 22H2<br/>
</details>

<details>
<summary>Software</summary>
Visual Studio Code<br/>
Version: 1.85.1 (user setup)<br/>
Date: 2023-12-13T09:49:37.021Z<br/>
Node.js: 18.15.0<br/>
</details>
