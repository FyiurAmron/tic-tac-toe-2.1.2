### Tic Tac Toe

Zadanie rekrutacyjne dla PHP

Zadanie polega na napisaniu obiektowej implementacji klasycznej gry "Kółko i Krzyżyk" (3x3).
(Jeśli nigdy nie grałeś, tutaj znajdziesz reguły)

Do wykonania zadania potrzebujesz jedynie instancji PHP w wersji wyższej bądź równej 7.1 oraz Composera ([https://getcomposer.org/](https://getcomposer.org/))

W załączniku znajdziesz początek projektu:

- klasę /Foo/ClassicTicTacToe - pustą klasę którą musisz uzupełnić
- klasę /Foo/Exceptions/FieldTakenException - klasę wyjątku który musisz wyrzucić w przypadku próby postawienia X/O na miejscu już zajętym
- klasę /Foo/Exceptions/WrongPlayerException - klasę wyjątku który musisz wyrzucić w przypadku próby zagrania 2 razy pod rząd tym samym graczem
- klasę /Foo/Marker którą wykorzystaj przy stawianiu ruchów
- interfejs /Foo/TicTacToeInterface z opisem (minimum) funkcji które musisz zaimplementować
- plik index.php który pokaże Ci przykładowe użycie klasy.
- pliki composer.json oraz composer.lock zawierające wymagane zewnętrzne pakiety koniecznie do uruchomienia projektu (właściwie tylko testów phpunit)

Dodatkowo (dla ułatwienia) udostępniamy zestaw testów, którymi będziemy sprawdzać Twój kod:

- plik phpunit.xml, który konfiguruje prosty zestaw testów gry.
- klasę testów Foo/Tests/ClassicTicTacToeTest

Testy uruchamiamy za pomocą komendy: `php vendor/bin/phpunit -c phpunit.xml`

Twoje zadanie polega na uzupełnieniu klasy ClassicTicTacToe o funkcje z interfejsu (minimum):

- putX - ustawia krzyżyk (który zwraca wyjątek w przypadku kiedy pole jest zajęte)
- putO - ustawia kółko (który zwraca wyjątek w przypadku kiedy pole jest zajęte)
- getWinner - zwraca instancję Marker zawierającą zwycięzcę X, O lub null w przypadku braku
- isEnded - sprawdza czy gra jest zakończona (jest zwycięzca lub jest remis)
- isTied - sprawdza czy jest remis (wszystkie pola zajęte i brak zwycięzcy)

Uwagi:

- Twój kod nie powinien nić wyświetlać! (tylko poprawnie, tj. zgodnie z opisem powyżej, zwracać odpowiednie wartości).
- Twój kod nie powinien zapisywać nic do bazy danych, ani innych miejsc - zapis stanu gry nie jest częścią zadania

# Powodzenia!
