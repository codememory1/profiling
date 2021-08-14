<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Codememory Profiler!</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">

    <!--My links-->
    <link rel="shortcut icon" href="data:image/png;base64,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" type="image/x-icon">
    <style>
        <?php echo file_get_contents(__DIR__.'/../css/profiler.css'); ?>
    </style>
</head>
<body class="dark-theme">

<!--Header-->
<header class="header">
    <div class="logo">
        <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZlcnNpb249IjEuMSIgeGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiCiAgICAgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ieE1pZFlNaWQgbWVldCIKICAgICB2aWV3Qm94PSItMC4wMDAwMDE1MTU4NDc2NTcxNzQxNjMgMS42NTEzNzc0ODgwODc3NDYzZS03IDMwMCA2NC40OTUzMzA4MTA1NDY4OCIgb3ZlcmZsb3c9InZpc2libGUiPgogICAgPGRlZnMgaWQ9IlN2Z2pzRGVmczUyNzg4NiI+CiAgICAgICAgPGxpbmVhckdyYWRpZW50IGlkPSJTdmdqc0xpbmVhckdyYWRpZW50N0ZGZzRmTXhFIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjUuMDQ1OTk5OTk5OTk5OTYzIgogICAgICAgICAgICAgICAgICAgICAgICB5MT0iOTQuOTUzMDAwMDAwMDAwMDYiIHgyPSI5NC45NTQwMDAwMDAwMDAwMSIgeTI9IjUuMDQ1MDAwMDAwMDAwMDAxIj4KICAgICAgICAgICAgPHN0b3AgaWQ9IlN2Z2pzU3RvcDUyNzg5MCIgc3RvcC1jb2xvcj0iI2EzNTI4MSIgb2Zmc2V0PSIwIj48L3N0b3A+CiAgICAgICAgICAgIDxzdG9wIGlkPSJTdmdqc1N0b3A1Mjc4OTEiIHN0b3AtY29sb3I9IiMyZjJmMzMiIG9mZnNldD0iMSI+PC9zdG9wPgogICAgICAgIDwvbGluZWFyR3JhZGllbnQ+CiAgICAgICAgPGxpbmVhckdyYWRpZW50IGlkPSJTdmdqc0xpbmVhckdyYWRpZW50T0EzeUJhLW8ycyIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiIHgxPSItMTA2LjMyOTk5OTk5OTk5OTk3IgogICAgICAgICAgICAgICAgICAgICAgICB5MT0iOTEuNTEiIHgyPSIxMDcuNTciIHkyPSItMTIyLjM5MDAwMDAwMDAwMDAxIj4KICAgICAgICAgICAgPHN0b3AgaWQ9IlN2Z2pzU3RvcDUyNzg5NCIgc3RvcC1jb2xvcj0iI2EzNTI4MSIgb2Zmc2V0PSIwIj48L3N0b3A+CiAgICAgICAgICAgIDxzdG9wIGlkPSJTdmdqc1N0b3A1Mjc4OTUiIHN0b3AtY29sb3I9IiMyZjJmMzMiIG9mZnNldD0iMSI+PC9zdG9wPgogICAgICAgIDwvbGluZWFyR3JhZGllbnQ+CiAgICA8L2RlZnM+CiAgICA8ZyBpZD0iU3ZnanNHNTI3ODg3IiB0cmFuc2Zvcm09InNjYWxlKDAuNTk5MjY5MDk5OTE5MDEwMykiIG9wYWNpdHk9IjEiPgogICAgICAgIDxnIGlkPSJTdmdqc0c1Mjc4ODgiIGNsYXNzPSJZeGJtN0VEMHMiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDExNS40MjgxNTYxNDkwNTMxMSwgOS43ODkxNDE2NTk1MDM2KSBzY2FsZSgxKSIKICAgICAgICAgICBsaWdodC1jb250ZW50PSJmYWxzZSIgZmlsbD0iI2Y3ZjdmNzhjIiBzdHlsZT0iCiAgICBmaWxsOiAjZjdmN2Y3OGM7CiI+CiAgICAgICAgICAgIDxwYXRoIGQ9IgkJCQlNIDc1LjU0MDgzNTA2MDk0NDk0LCA0NC45MTcwODM4NTQ2OTgyOAoJCQkJbSAwLCAtNDQuOTE3MDgzODU0Njk4MjgKCQkJCWEgNzYuMDQwODM1MDYwOTQ0OTQsIDQ0LjkxNzA4Mzg1NDY5ODI4LCAwLCAxLCAwLCAxLCAwCgkJCQlaCgkJCSI+PC9wYXRoPgogICAgICAgIDwvZz4KICAgICAgICA8ZyBpZD0iU3ZnanNHNTI3ODkyIiBjbGFzcz0ieXR6OFBCNkhqIgogICAgICAgICAgIHRyYW5zZm9ybT0idHJhbnNsYXRlKC02LjMwNTUwNDU4NzE4MTMyOCwgLTUuNzA2NzM3NTg1NjA0NTQ1KSBzY2FsZSgxLjE5MDM5MTY1MzIzNDE1NykiIGxpZ2h0LWNvbnRlbnQ9ImZhbHNlIgogICAgICAgICAgIG5vbi1zdHJva2FibGU9ImZhbHNlIiBmaWxsPSIjZmZmIj4KICAgICAgICAgICAgPHBhdGggZD0iTTk0LjcwMyA1My44ODZhMTUuNTQgMTUuNTQgMCAwIDAtNC44OTctMTEuMjkyIDE1LjQ1NiAxNS40NTYgMCAwIDAgMi43MzMtOC43NzVjMC03LjA4My00Ljg5My0xMy4yNTktMTEuNjI2LTE1LjAwMi0uNzUxLTcuODU3LTcuMzkxLTE0LjAyMi0xNS40NDItMTQuMDIyQzYwLjEwOSA0Ljc5NCA1My4zMTIgNC44IDQ5Ljk5OCAxMCA0Ni42ODUgNC44IDM5Ljg5IDQuNzk0IDM0LjUzIDQuNzk0Yy04LjA1MSAwLTE0LjY5IDYuMTY2LTE1LjQ0MiAxNC4wMjItNi43MzQgMS43NDUtMTEuNjI5IDcuOTIxLTExLjYyOSAxNS4wMDIgMCAzLjE0Ny45NTkgNi4xOTcgMi43MzQgOC43NzVhMTUuNTM0IDE1LjUzNCAwIDAgMC00Ljg5NiAxMS4yOTJjMCA2LjA0NCAzLjUyNSAxMS40OTYgOC45MiAxNC4wMzItLjAxOS4yOTEtLjAyOC41NzQtLjAyOC44NTQgMCA1LjE5NiAyLjYzIDEwLjA1MSA2LjkyOSAxMi45MTIuOTg0IDcuNjYzIDcuNTQgMTMuNTIxIDE1LjM2OCAxMy41MjEgNS43OTQgMCAxMC44NDktMy4yIDEzLjUxMS03LjkyMSAyLjY2NSA0LjcyMSA3LjcyMSA3LjkyMSAxMy41MTggNy45MjEgNy44MjcgMCAxNC4zODMtNS44NTkgMTUuMzY4LTEzLjUyMiA0LjI5Ny0yLjg2NCA2LjkyNy03LjcxOSA2LjkyNy0xMi45MTEgMC0uMjgtLjAwOS0uNTYzLS4wMjctLjg1NGExNS41MjMgMTUuNTIzIDAgMCAwIDguOTItMTQuMDMxek04Mi45NzEgNjQuNzUyYTEuOTk4IDEuOTk4IDAgMCAwLTEuMzE4IDIuMTkzYy4xMDguNy4xNTggMS4yOC4xNTggMS44MjdhMTEuNTUgMTEuNTUgMCAwIDEtNS44MTYgOS45OTcgMiAyIDAgMCAwLTEuMDA0IDEuNjE3Yy0uMzYzIDYuMDY2LTUuNDAzIDEwLjgxOS0xMS40NzUgMTAuODE5LTYuMzUyIDAtMTEuNTE5LTUuMTY1LTExLjUxOS0xMS41MTVhMiAyIDAgMCAwLTQgMGMwIDYuMzUtNS4xNjQgMTEuNTE1LTExLjUxMSAxMS41MTUtNi4wNzIgMC0xMS4xMTItNC43NTMtMTEuNDc0LTEwLjgxOWEyIDIgMCAwIDAtMS4wMDYtMS42MTggMTEuNTM3IDExLjUzNyAwIDAgMS01LjgxNy05Ljk5NmMwLS41NDYuMDUxLTEuMTI1LjE2LTEuODIxYTIgMiAwIDAgMC0xLjMxNy0yLjE5OSAxMS41MjQgMTEuNTI0IDAgMCAxLTcuNzM1LTEwLjg2NmMwLTMuNzAyIDEuODA5LTcuMjA0IDQuODM5LTkuMzY2YTIgMiAwIDAgMCAuMzIxLTIuOTcxIDExLjUwNCAxMS41MDQgMCAwIDEtMi45OTgtNy43M2MwLTUuNjczIDQuMjM1LTEwLjU2MyA5Ljg1Mi0xMS4zNzVhMiAyIDAgMCAwIDEuNzA3LTIuMTM4YzAtNi4zNDcgNS4xNjUtMTEuNTExIDExLjUxMy0xMS41MTEgOC4zNSAwIDEzLjQ2Ny40NiAxMy40NjcgOS41M2EyIDIgMCAwIDAgNCAwYzAtOS4wNyA1LjEyLTkuNTMgMTMuNDc0LTkuNTMgNi4zNDkgMCAxMS41MTQgNS4xNjQgMTEuNTE0IDExLjQ3OGE2LjI1IDYuMjUgMCAwIDAtLjAwNi4xOTIgMiAyIDAgMCAwIDEuNzE0IDEuOTc5YzUuNjEzLjgxMSA5Ljg0NyA1LjcwMSA5Ljg0NyAxMS4zNzUgMCAyLjg1My0xLjA2NCA1LjU5OC0yLjk5NyA3LjczYTIgMiAwIDAgMCAuMzE5IDIuOTcyIDExLjUzOSAxMS41MzkgMCAwIDEgNC44NDIgOS4zNjYgMTEuNTI5IDExLjUyOSAwIDAgMS03LjczNCAxMC44NjV6Ij48L3BhdGg+CiAgICAgICAgICAgIDxwYXRoIGQ9Ik03My43NTMgMzAuMzAzYzAtNC44NTMtMy45NDgtOC44MDEtOC44MDEtOC44MDEtNC44NTQgMC04LjgwMiAzLjk0OC04LjgwMiA4LjgwMSAwIDIuMDguNzI5IDMuOTkgMS45MzkgNS40OTctLjM1MyAxMC41NzktOC40NyAxOS4xMjItMTguNjEzIDE5LjY3NS0xLjYwNy0yLjEzNi00LjE1NS0zLjUyNS03LjAyOC0zLjUyNWE4Ljc1MSA4Ljc1MSAwIDAgMC0zLjI0MS42MjZjLTIuMDU5LTMuMTk0LTEuNTY1LTcuMjQzLS4zODEtOS45NjIuODI0LTEuODkzIDEuODgtMi45NzQgMi42MDItMy4zNDlhOC43NDEgOC43NDEgMCAwIDAgNS4xMDcgMS42NDhjNC44NTQgMCA4LjgwMi0zLjk0OCA4LjgwMi04LjgwMXMtMy45NDgtOC44MDEtOC44MDItOC44MDFjLTQuODUzIDAtOC44MDEgMy45NDgtOC44MDEgOC44MDEgMCAxLjQ5Mi4zNzUgMi44OTYgMS4wMzMgNC4xMjgtMS40MDkgMS4wMTEtMi42ODIgMi42NDktMy42MDkgNC43NzYtMS42MTkgMy43MTgtMi4yMyA5LjMyMS43NjcgMTMuODQ3YTguNzU1IDguNzU1IDAgMCAwLTIuMjc5IDUuODg4YzAgNC44NTMgMy45NDggOC44MDEgOC44MDIgOC44MDEgNC44NTMgMCA4LjgwMS0zLjk0OCA4LjgwMS04LjgwMSAwLS40NzItLjA0OC0uOTMyLS4xMi0xLjM4MyAxMC42OTUtMS4yNTQgMTkuMjQ4LTkuODgzIDIwLjc1My0yMC44MjZhOC43MzMgOC43MzMgMCAwIDAgMy4wNjguNTYzYy43NTQgMCAxLjQ4MS0uMTA1IDIuMTgxLS4yODUgMy4yNTUgOC4wMTkgMS41OTQgMTQuMDQuNjc0IDE2LjM1My0uNzA4IDEuNzgxLTEuNTIyIDIuODQtMi4wNDEgMy4zMTVhOC43NDYgOC43NDYgMCAwIDAtNC4zNjgtMS4xNzFjLTQuODU0IDAtOC44MDIgMy45NDgtOC44MDIgOC44MDIgMCA0Ljg1MyAzLjk0OCA4LjgwMSA4LjgwMiA4LjgwMSA0Ljg1MyAwIDguODAxLTMuOTQ4IDguODAxLTguODAxIDAtMS44MTgtLjU1NS0zLjUxLTEuNTAzLTQuOTE0YTEwLjQ3MyAxMC40NzMgMCAwIDAgMS40ODItMS44NzVjMi44MDEtNC40NDEgNC40ODYtMTIuODM3LjUwOC0yMi4zNjNhOC43NzggOC43NzggMCAwIDAgMy4wNjktNi42NjR6bS0zNy4yMTctMi45OTRjMi42NDcgMCA0LjgwMiAyLjE1NCA0LjgwMiA0LjgwMXMtMi4xNTQgNC44MDEtNC44MDIgNC44MDFjLTIuNjQ3IDAtNC44MDEtMi4xNTQtNC44MDEtNC44MDFzMi4xNTQtNC44MDEgNC44MDEtNC44MDF6bS00LjA4NyAzOC4yNDJjLTIuNjQ3IDAtNC44MDItMi4xNTMtNC44MDItNC44MDFzMi4xNTQtNC44MDEgNC44MDItNC44MDFjMi42NDcgMCA0LjgwMSAyLjE1MyA0LjgwMSA0LjgwMXMtMi4xNTQgNC44MDEtNC44MDEgNC44MDF6bTI4Ljk0OCA1LjM2OGMtMi42NDcgMC00LjgwMi0yLjE1My00LjgwMi00LjgwMXMyLjE1NC00LjgwMiA0LjgwMi00LjgwMiA0LjgwMSAyLjE1NCA0LjgwMSA0LjgwMi0yLjE1MyA0LjgwMS00LjgwMSA0LjgwMXpNNjAuMTUgMzAuMzAzYzAtMi42NDcgMi4xNTQtNC44MDEgNC44MDItNC44MDFzNC44MDEgMi4xNTQgNC44MDEgNC44MDEtMi4xNTMgNC44MDEtNC44MDEgNC44MDEtNC44MDItMi4xNTQtNC44MDItNC44MDF6Ij48L3BhdGg+CiAgICAgICAgPC9nPgogICAgICAgIDxnIGlkPSJTdmdqc0c1Mjc4OTYiIGNsYXNzPSJ0ZXh0IiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgzMTIuNDM5ODI2MjcwOTQzLCA3Mi41MjM3OTE3NTQ5NzU4Nikgc2NhbGUoMSkiCiAgICAgICAgICAgbGlnaHQtY29udGVudD0iZmFsc2UiIGZpbGw9IiNmZmYiPgogICAgICAgICAgICA8cGF0aCBkPSJNLTE4MS4zOCAtNC43MUMtMTc3LjY4IC0xLjE2IC0xNzIuMzggMC42MiAtMTY1LjQ4IDAuNjJDLTE2MS4wNiAwLjYyIC0xNTcuMDMgMCAtMTUzLjM5IC0xLjI0TC0xNTMuMzkgLTEwLjA0Qy0xNTYuOSAtOC42IC0xNjAuNjYgLTcuODcgLTE2NC42NyAtNy44N0MtMTY4LjcyIC03Ljg3IC0xNzEuNzUgLTguODMgLTE3My43NSAtMTAuNzZDLTE3NS43NiAtMTIuNjggLTE3Ni43NiAtMTUuNjQgLTE3Ni43NiAtMTkuNjVDLTE3Ni43NiAtMjMuOTEgLTE3NS44IC0yNy4wMyAtMTczLjg4IC0yOS4wMkMtMTcxLjk2IC0zMSAtMTY4LjkzIC0zMS45OSAtMTY0LjggLTMxLjk5Qy0xNjAuODMgLTMxLjk5IC0xNTcuMDUgLTMxLjI1IC0xNTMuNDUgLTI5Ljc2TC0xNTMuNDUgLTM4LjVDLTE1NS4zNSAtMzkuMTYgLTE1Ny4yNiAtMzkuNjcgLTE1OS4xOCAtNDAuMDJDLTE2MS4xMSAtNDAuMzcgLTE2My4yMyAtNDAuNTUgLTE2NS41NCAtNDAuNTVDLTE3Mi42MSAtNDAuNTUgLTE3Ny45NCAtMzguNzUgLTE4MS41NCAtMzUuMTVDLTE4NS4xMyAtMzEuNTYgLTE4Ni45MyAtMjYuMzkgLTE4Ni45MyAtMTkuNjVDLTE4Ni45MyAtMTMuMjUgLTE4NS4wOCAtOC4yNyAtMTgxLjM4IC00LjcxWiBNLTE1Mi4zMyAtMTQuNjlDLTE1Mi4zMyAtNC40OCAtMTQ2LjgyIDAuNjIgLTEzNS43OCAwLjYyQy0xMjQuNyAwLjYyIC0xMTkuMTYgLTQuNDggLTExOS4xNiAtMTQuNjlDLTExOS4xNiAtMTkuNyAtMTIwLjU0IC0yMy41IC0xMjMuMjkgLTI2LjFDLTEyNi4wNCAtMjguNzEgLTEzMC4yIC0zMC4wMSAtMTM1Ljc4IC0zMC4wMUMtMTQxLjMyIC0zMC4wMSAtMTQ1LjQ2IC0yOC43IC0xNDguMjEgLTI2LjA3Qy0xNTAuOTYgLTIzLjQ1IC0xNTIuMzMgLTE5LjY1IC0xNTIuMzMgLTE0LjY5Wk0tMTMwLjgyIC04LjkzQy0xMzEuODEgLTcuNzcgLTEzMy40NyAtNy4xOSAtMTM1Ljc4IC03LjE5Qy0xMzguMDUgLTcuMTkgLTEzOS42OSAtNy43NyAtMTQwLjY4IC04LjkzQy0xNDEuNjcgLTEwLjA5IC0xNDIuMTcgLTEyLjAxIC0xNDIuMTcgLTE0LjY5Qy0xNDIuMTcgLTE3LjM0IC0xNDEuNjcgLTE5LjI1IC0xNDAuNjggLTIwLjQzQy0xMzkuNjkgLTIxLjYxIC0xMzguMDUgLTIyLjIgLTEzNS43OCAtMjIuMkMtMTMzLjUxIC0yMi4yIC0xMzEuODYgLTIxLjYyIC0xMzAuODUgLTIwLjQ2Qy0xMjkuODQgLTE5LjMgLTEyOS4zMyAtMTcuMzggLTEyOS4zMyAtMTQuNjlDLTEyOS4zMyAtMTIuMDEgLTEyOS44MyAtMTAuMDkgLTEzMC44MiAtOC45M1ogTS0xMTIuODQgLTIuN0MtMTEwLjU3IC0wLjQ5IC0xMDcuMTggMC42MiAtMTAyLjY3IDAuNjJDLTEwMC43MyAwLjYyIC05OS4wMSAwLjM2IC05Ny41MyAtMC4xNUMtOTYuMDQgLTAuNjcgLTk0LjY3IC0xLjQ1IC05My40MyAtMi40OEwtOTIuODggMEwtODQuMjYgMEwtODQuMjYgLTQxLjc5TC05NC4yNCAtNDEuNzlMLTk0LjI0IC0yOC4wMkMtOTYuNDMgLTI5LjM1IC05OC45NSAtMzAuMDEgLTEwMS44IC0zMC4wMUMtMTA0LjY2IC0zMC4wMSAtMTA3LjE3IC0yOS4zOCAtMTA5LjM0IC0yOC4xMkMtMTExLjUxIC0yNi44NiAtMTEzLjIgLTI1IC0xMTQuNDIgLTIyLjU0Qy0xMTUuNjQgLTIwLjA4IC0xMTYuMjUgLTE3LjExIC0xMTYuMjUgLTEzLjY0Qy0xMTYuMjUgLTguNTYgLTExNS4xMSAtNC45MSAtMTEyLjg0IC0yLjdaTS05NC4yNCAtOC44N0MtOTUuNzcgLTcuMzggLTk3LjYzIC02LjYzIC05OS44MiAtNi42M0MtMTAyLjAxIC02LjYzIC0xMDMuNiAtNy4xMiAtMTA0LjU5IC04LjA5Qy0xMDUuNTkgLTkuMDYgLTEwNi4wOCAtMTAuODkgLTEwNi4wOCAtMTMuNThDLTEwNi4wOCAtMTYuNDcgLTEwNS41MyAtMTguNzEgLTEwNC40NCAtMjAuM0MtMTAzLjM0IC0yMS45IC0xMDEuNzQgLTIyLjY5IC05OS42MyAtMjIuNjlDLTk3LjQ0IC0yMi42OSAtOTUuNjUgLTIyLjA1IC05NC4yNCAtMjAuNzdaIE0tNzQuNjIgLTMuMjlDLTcxLjU4IC0wLjY4IC02Ny40NCAwLjYyIC02Mi4xOSAwLjYyQy01Ny4zOSAwLjYyIC01My41OSAtMC4wMiAtNTAuNzggLTEuM0wtNTAuNzggLTcuODFDLTUxLjg5IC03LjM2IC01My4yOSAtNi45OSAtNTQuOTYgLTYuN0MtNTYuNjQgLTYuNDEgLTU4LjI4IC02LjI2IC01OS44OSAtNi4yNkMtNjIuOTEgLTYuMjYgLTY1LjIyIC02LjY1IC02Ni44NCAtNy40NEMtNjguNDUgLTguMjMgLTY5LjQ4IC05LjU3IC02OS45NCAtMTEuNDdMLTQ5LjEgLTExLjQ3TC00OS4xIC0xNi43NEMtNDkuMSAtMjAuNzkgLTUwLjQxIC0yNC4wMSAtNTMuMDEgLTI2LjQxQy01NS42MSAtMjguODEgLTU5LjIxIC0zMC4wMSAtNjMuOCAtMzAuMDFDLTY4LjggLTMwLjAxIC03Mi42MSAtMjguNjUgLTc1LjI0IC0yNS45NUMtNzcuODYgLTIzLjI0IC03OS4xNyAtMTkuNDkgLTc5LjE3IC0xNC42OUMtNzkuMTcgLTkuNjkgLTc3LjY1IC01Ljg5IC03NC42MiAtMy4yOVpNLTU3Ljc4IC0xNy4yNEwtNjkuOTQgLTE3LjI0Qy02OS45NCAtMTkuMzQgLTY5LjQ1IC0yMC44NyAtNjguNDggLTIxLjgyQy02Ny41MSAtMjIuNzcgLTY1Ljg0IC0yMy4yNSAtNjMuNDkgLTIzLjI1Qy01OS42OSAtMjMuMjUgLTU3Ljc4IC0yMS42OCAtNTcuNzggLTE4LjU0WiBNLTQ0LjAyIC0yOS4zOUwtNDQuMDIgMEwtMzQuMjkgMEwtMzQuMjkgLTE5Ljk2Qy0zMi40MyAtMjEuNzQgLTMwLjYzIC0yMi42MyAtMjguODkgLTIyLjYzQy0yNy40OSAtMjIuNjMgLTI2LjUyIC0yMi4yOCAtMjUuOTggLTIxLjU4Qy0yNS40NCAtMjAuODcgLTI1LjE3IC0xOS43NCAtMjUuMTcgLTE4LjE3TC0yNS4xNyAwTC0xNS44NyAwTC0xNS44NyAtMTcuNjFDLTE1Ljg3IC0xOC44NSAtMTUuOTMgLTE5Ljc4IC0xNi4wNiAtMjAuNEMtMTUuNDQgLTIxLjEgLTE0LjY4IC0yMS42NSAtMTMuOCAtMjIuMDRDLTEyLjkxIC0yMi40MyAtMTEuOTcgLTIyLjYzIC0xMC45NyAtMjIuNjNDLTkuNDQgLTIyLjYzIC04LjM0IC0yMi4yNyAtNy42NiAtMjEuNTRDLTYuOTggLTIwLjgyIC02LjYzIC0xOS42NSAtNi42MyAtMTguMDRMLTYuNjMgMEwzLjIyIDBMMy4yMiAtMTkuMjJDMy4yMiAtMjIuODYgMi40MSAtMjUuNTYgMC43NyAtMjcuMzRDLTAuODYgLTI5LjEyIC0zLjM3IC0zMC4wMSAtNi43NiAtMzAuMDFDLTguOTUgLTMwLjAxIC0xMC45IC0yOS43MSAtMTIuNjIgLTI5LjExQy0xNC4zMyAtMjguNTEgLTE1LjkzIC0yNy42NyAtMTcuNDIgLTI2LjZDLTE4LjA4IC0yNy43MSAtMTguOTggLTI4LjU2IC0yMC4xMiAtMjkuMTRDLTIxLjI2IC0yOS43MiAtMjIuNzcgLTMwLjAxIC0yNC42OCAtMzAuMDFDLTI4LjIzIC0zMC4wMSAtMzEuNSAtMjguOTMgLTM0LjQ3IC0yNi43OEwtMzQuNzggLTI5LjM5WiBNMTIuNTYgLTMuMjlDMTUuNTkgLTAuNjggMTkuNzQgMC42MiAyNC45OSAwLjYyQzI5Ljc4IDAuNjIgMzMuNTggLTAuMDIgMzYuMzkgLTEuM0wzNi4zOSAtNy44MUMzNS4yOCAtNy4zNiAzMy44OCAtNi45OSAzMi4yMSAtNi43QzMwLjU0IC02LjQxIDI4Ljg5IC02LjI2IDI3LjI4IC02LjI2QzI0LjI2IC02LjI2IDIxLjk1IC02LjY1IDIwLjM0IC03LjQ0QzE4LjcyIC04LjIzIDE3LjY5IC05LjU3IDE3LjI0IC0xMS40N0wzOC4wNyAtMTEuNDdMMzguMDcgLTE2Ljc0QzM4LjA3IC0yMC43OSAzNi43NyAtMjQuMDEgMzQuMTYgLTI2LjQxQzMxLjU2IC0yOC44MSAyNy45NiAtMzAuMDEgMjMuMzcgLTMwLjAxQzE4LjM3IC0zMC4wMSAxNC41NiAtMjguNjUgMTEuOTQgLTI1Ljk1QzkuMzEgLTIzLjI0IDggLTE5LjQ5IDggLTE0LjY5QzggLTkuNjkgOS41MiAtNS44OSAxMi41NiAtMy4yOVpNMjkuMzkgLTE3LjI0TDE3LjI0IC0xNy4yNEMxNy4yNCAtMTkuMzQgMTcuNzIgLTIwLjg3IDE4LjY5IC0yMS44MkMxOS42NiAtMjIuNzcgMjEuMzMgLTIzLjI1IDIzLjY4IC0yMy4yNUMyNy40OSAtMjMuMjUgMjkuMzkgLTIxLjY4IDI5LjM5IC0xOC41NFogTTQzLjE1IC0yOS4zOUw0My4xNSAwTDUyLjg5IDBMNTIuODkgLTE5Ljk2QzU0Ljc1IC0yMS43NCA1Ni41NCAtMjIuNjMgNTguMjggLTIyLjYzQzU5LjY5IC0yMi42MyA2MC42NiAtMjIuMjggNjEuMTkgLTIxLjU4QzYxLjczIC0yMC44NyA2MiAtMTkuNzQgNjIgLTE4LjE3TDYyIDBMNzEuMyAwTDcxLjMgLTE3LjYxQzcxLjMgLTE4Ljg1IDcxLjI0IC0xOS43OCA3MS4xMSAtMjAuNEM3MS43MyAtMjEuMSA3Mi40OSAtMjEuNjUgNzMuMzggLTIyLjA0Qzc0LjI3IC0yMi40MyA3NS4yMSAtMjIuNjMgNzYuMiAtMjIuNjNDNzcuNzMgLTIyLjYzIDc4LjgzIC0yMi4yNyA3OS41MiAtMjEuNTRDODAuMiAtMjAuODIgODAuNTQgLTE5LjY1IDgwLjU0IC0xOC4wNEw4MC41NCAwTDkwLjQgMEw5MC40IC0xOS4yMkM5MC40IC0yMi44NiA4OS41OCAtMjUuNTYgODcuOTUgLTI3LjM0Qzg2LjMxIC0yOS4xMiA4My44IC0zMC4wMSA4MC40MSAtMzAuMDFDNzguMjIgLTMwLjAxIDc2LjI3IC0yOS43MSA3NC41NiAtMjkuMTFDNzIuODQgLTI4LjUxIDcxLjI0IC0yNy42NyA2OS43NSAtMjYuNkM2OS4wOSAtMjcuNzEgNjguMTkgLTI4LjU2IDY3LjA1IC0yOS4xNEM2NS45MiAtMjkuNzIgNjQuNCAtMzAuMDEgNjIuNSAtMzAuMDFDNTguOTQgLTMwLjAxIDU1LjY4IC0yOC45MyA1Mi43IC0yNi43OEw1Mi4zOSAtMjkuMzlaIE05NC4xOCAtMTQuNjlDOTQuMTggLTQuNDggOTkuNyAwLjYyIDExMC43MyAwLjYyQzEyMS44MSAwLjYyIDEyNy4zNSAtNC40OCAxMjcuMzUgLTE0LjY5QzEyNy4zNSAtMTkuNyAxMjUuOTcgLTIzLjUgMTIzLjIzIC0yNi4xQzEyMC40OCAtMjguNzEgMTE2LjMxIC0zMC4wMSAxMTAuNzMgLTMwLjAxQzEwNS4xOSAtMzAuMDEgMTAxLjA1IC0yOC43IDk4LjMgLTI2LjA3Qzk1LjU1IC0yMy40NSA5NC4xOCAtMTkuNjUgOTQuMTggLTE0LjY5Wk0xMTUuNjkgLTguOTNDMTE0LjcgLTcuNzcgMTEzLjA1IC03LjE5IDExMC43MyAtNy4xOUMxMDguNDYgLTcuMTkgMTA2LjgzIC03Ljc3IDEwNS44MyAtOC45M0MxMDQuODQgLTEwLjA5IDEwNC4zNSAtMTIuMDEgMTA0LjM1IC0xNC42OUMxMDQuMzUgLTE3LjM0IDEwNC44NCAtMTkuMjUgMTA1LjgzIC0yMC40M0MxMDYuODMgLTIxLjYxIDEwOC40NiAtMjIuMiAxMTAuNzMgLTIyLjJDMTEzLjAxIC0yMi4yIDExNC42NSAtMjEuNjIgMTE1LjY2IC0yMC40NkMxMTYuNjcgLTE5LjMgMTE3LjE4IC0xNy4zOCAxMTcuMTggLTE0LjY5QzExNy4xOCAtMTIuMDEgMTE2LjY4IC0xMC4wOSAxMTUuNjkgLTguOTNaIE0xMzIuNDMgLTI5LjM5TDEzMi40MyAwTDE0Mi40MSAwTDE0Mi40MSAtMTkuNzhDMTQzLjU3IC0yMC4zNiAxNDUuMTQgLTIwLjkgMTQ3LjEzIC0yMS40MkMxNDkuMTEgLTIxLjk0IDE1MC45NyAtMjIuMyAxNTIuNzEgLTIyLjUxTDE1Mi43MSAtMzAuMDFDMTUwLjg1IC0yOS44NCAxNDguOTcgLTI5LjQ0IDE0Ny4wNiAtMjguOEMxNDUuMTYgLTI4LjE2IDE0My41NSAtMjcuNDUgMTQyLjIzIC0yNi42NkwxNDEuOTIgLTI5LjM5WiBNMTU4LjAxIDEwLjdDMTU5LjA2IDEwLjg0IDE2MC4zNSAxMC45MSAxNjEuODggMTAuOTFDMTY1LjQ4IDEwLjkxIDE2OC40MyA5Ljc5IDE3MC43NSA3LjUzQzE3My4wNiA1LjI4IDE3NS4xMyAxLjk2IDE3Ni45NSAtMi40MkwxODguMTcgLTI5LjM5TDE3Ny43NSAtMjkuMzlMMTcwLjEzIC0xMC43M0wxNjIuMzggLTI5LjM5TDE1MS45IC0yOS4zOUwxNjUuMTEgLTAuNTZDMTY0LjI0IDEuMDEgMTYzLjM3IDIuMDkgMTYyLjUgMi42N0MxNjEuNjMgMy4yNCAxNjAuMzcgMy41MyAxNTguNzIgMy41M0MxNTcuMzYgMy41MyAxNTYuMSAzLjMzIDE1NC45NCAyLjkxTDE1NC45NCA5Ljg2QzE1NS45MyAxMC4yNyAxNTYuOTUgMTAuNTUgMTU4LjAxIDEwLjdaIj48L3BhdGg+CiAgICAgICAgPC9nPgogICAgPC9nPgo8L3N2Zz4=" alt="">
        <span>Profiler</span>
    </div>
    <div class="right_header">
        <div class="change_theme">
            <select>
                <option selected disabled>Change theme</option>
                <option value="dark-theme">Dark</option>
                <option value="blue-theme">Blue</option>
                <option value="light-theme">Light</option>
            </select>
        </div>
        <div class="framework-version">
            Codememory: <span class="version">v1.4</span>
        </div>
    </div>
</header>
<main class="main">
    <aside class="menu">
        <ul class="navigation">
            <li class="navigation_item">
                <div class="navigation_item-link">
                    <i class="fas fa-head-vr"></i> Profiler
                </div>
                <ul class="navigation">
                    <a href="?_cdm-profiler=list-reports">
                        <li class="navigation_item">List of reports</li>
                    </a>
                    <a href="?_cdm-profiler=create-compare">
                        <li class="navigation_item">Compare reports</li>
                    </a>
                    <a href="#">
                        <li class="navigation_item">General statistics of the report</li>
                    </a>
                </ul>
            </li>
            <li class="navigation_item">
                <div class="navigation_item-link"><i class="fas fa-road"></i> Router</div>
            </li>
            <li class="navigation_item">
                <div class="navigation_item-link"><i class="fas fa-book"></i> Log</div>
            </li>
        </ul>
    </aside>
<!--    More details-->
<!--    <div class="content">-->
<!--        <div class="profiling__header">-->
<!--            <div class="profiling_reports">-->
<!--                <div class="profiling__header-title">Opened reports:</div>-->
<!--                <div class="profiling-reports_items">-->
<!--                    --><?php
//                        $openedReports = [];
//
//                        if(isset($_GET['run-reports'])) {
//                            $openedReports = explode('@', $_GET['run-reports']);
//                        }
//                    ?>
<!--                    --><?php //foreach ($openedReports as $report): ?>
<!--                        <span>#-->
<!--                            <span class="report_id">--><?php //echo $report; ?><!--</span>-->
<!--                            <span>(2021-07-16 14:55:22)</span>-->
<!--                        </span>-->
<!--                    --><?php //endforeach; ?>
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="container_more-details">-->
<!--            <div class="wrap-more-detail">-->
<!--                <span class="more-detail_title">Name</span>-->
<!--                <span class="more-detail_value">Kernel\FrameworkBuilder::__construct</span>-->
<!--            </div>-->
<!--            <div class="wrap-more-detail">-->
<!--                <span class="more-detail_title">Calls</span>-->
<!--                <span class="more-detail_value">1 <span class="green-text">+10</span></span>-->
<!--            </div>-->
<!--            <div class="wrap-more-detail">-->
<!--                <span class="more-detail_title">Lead time</span>-->
<!--                <span class="more-detail_value">120 000 ms <span class="red-text">-16 000</span></span>-->
<!--            </div>-->
<!--            <div class="wrap-more-detail">-->
<!--                <span class="more-detail_title">Lead time CPU</span>-->
<!--                <span class="more-detail_value">120 000 ms <span class="green-text">+2 000</span></span>-->
<!--            </div>-->
<!--            <div class="wrap-more-detail">-->
<!--                <span class="more-detail_title">ICou</span>-->
<!--                <span class="more-detail_value">100.00% <span class="green-text">+0.00%</span></span>-->
<!--            </div>-->
<!--            <div class="wrap-more-detail">-->
<!--                <span class="more-detail_title">Memory used</span>-->
<!--                <span class="more-detail_value">4 000 byte <span class="red-text">-1 000</span></span>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

    <?php if(array_key_exists('_cdm-profiler', $_GET) && $_GET['_cdm-profiler'] === 'opened-report'): ?>
        <div class="content">
            <div class="profiling__header">
                <div class="profiling_reports">
                    <div class="profiling__header-title">Opened reports:</div>
                    <div class="profiling-reports_items">
                        <?php
                            $openedReports = [];

                            if(isset($_GET['run-reports'])) {
                                $openedReports = explode('@', $_GET['run-reports']);
                            }
                        ?>
                        <?php foreach ($openedReports as $report): ?>
                            <span>#
                                <span class="report_id"><?php echo $report; ?></span>
                                <span>(2021-07-16 14:55:22)</span>
                            </span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="profiling__content">
                <table class="profiling_table">
                    <thead class="profiling-table_head">
                        <th>Name</th>
                        <th>Calls</th>
                        <th>Lead time</th>
                        <th>Lead time CPU</th>
                        <th>Actions</th>
                    </thead>
                    <tbody class="profiling-table_body">

                        <?php foreach ($this->getUniqueComponentNamesWithData($this->getReport($_GET['run-reports']), 'wt') as $componentName => $data): ?>
                        <tr>
                            <td><?=$componentName;?></td>
                            <td>
                                <?=$data['ct'];?>
                            </td>
                            <td>
                                <?=$data['wt'];?> ms
                            </td>
                            <td>
                                <?=$data['cpu'];?> ms
                            </td>
                            <td class="function_actions">
                                <a href="#" class="function_action green">Open</a>
                                <a href="#" class="function_action blue">More details</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>


    <?php if(array_key_exists('_cdm-profiler', $_GET) && $_GET['_cdm-profiler'] === 'create-compare'): ?>
    <div class="content">
        <div class="wrap_section-add-hash">
            <div class="wrap_sections_create-compare">
                <div class="wrap_to_column section_create-compare">
                    <span>List of added reports for comparison:</span>
                    <div class="added-reports-for-compare"></div>
                </div>
                <div class="wrap_to_column section_create-compare" style="width: 50%">
                    <span>Choose a hash of the report:</span>
                    <select class="list_reports-select">
                        <?php foreach ($this->getReports() as $hash => $data): ?>
                            <option value="<?=$hash;?>">#<?=$hash;?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <a href="#" class="btn green btn_add-report">Add hash to list</a>
            <a href="?_cdm-profiler=result-compare" class="btn blue btn_add-report btn-compare" style="margin-left: 10px">Compare reports</a>
        </div>
    </div>
    <?php endif; ?>

    <?php if(array_key_exists('_cdm-profiler', $_GET) && $_GET['_cdm-profiler'] === 'list-reports'): ?>
    <div class="content">
        <div class="list_reports">
            <table class="profiling_table">
                <thead class="profiling-table_head">
<!--                    <th>id</th>-->
                    <th>Hash</th>
<!--                    <th>Date of creation</th>-->
                    <th>Actions</th>
                </thead>
                <tbody class="profiling-table_body">
                    <?php foreach ($this->getReports() as $hash => $data): ?>
                        <tr>
<!--                            <td>2</td>-->
                            <td>
                                # <span class="blue-text"><?=$hash;?></span>
                            </td>
<!--                            <td>-->
<!--                                2021-08-08 14:55:23-->
<!--                            </td>-->
                            <td class="function_actions">
                                <a href="?_cdm-profiler=opened-report&run-reports=<?=$hash;?>" class="function_action green">Open</a>
                                <a href="#" class="function_action red">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>

    <?php if(array_key_exists('_cdm-profiler', $_GET) && $_GET['_cdm-profiler'] === 'result-compare'): ?>
    <div class="content">
        <div class="profiling__header">
            <div class="profiling_reports">
                <div class="profiling__header-title">Opened reports:</div>
                <div class="profiling-reports_items">
                    <?php
                        $openedReports = [];

                        if(isset($_GET['run-reports'])) {
                            $openedReports = explode('@', $_GET['run-reports']);
                        }
                    ?>
                    <?php foreach ($openedReports as $report): ?>
                        <span>#
                            <span class="report_id"><?php echo $report; ?></span>
                            <span>(2021-07-16 14:55:22)</span>
                        </span>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php
                $diffReport = $this->diffReports($this->getReport($openedReports[0]), $this->getReport($openedReports[1]), 'wt');
                $diffReport = $this->getUniqueComponentNamesWithData($diffReport);
                $diffCommonReplaced = $this->getDiffCommonNumbers($diffReport);
            ?>
            <div class="profiling_reports">
                <div class="profiling__header-title">Sum statistics lead time:</div>
                <div class="profiling-reports_items">
                    <div class="comparison-statistics_wrap" data-comparison="*%">
                        <div class="comparison-statistics">
                            <span class="green-square"></span>
                            <span class="green-text">+<?=$diffCommonReplaced['added']['wt']; ?> ms <br>+<?=$diffCommonReplaced['added']['wt'] / 1e+6;?> s</span>
                        </div>
                        <div class="comparison-statistics">
                            <span class="red-square"></span>
                            <span class="red-text"><?=$diffCommonReplaced['removed']['wt']; ?> ms <br><?=$diffCommonReplaced['removed']['wt'] / 1e+6;?> s</span>
                        </div>
                    </div>
                    <span class="report_sum-text">Comparison report:</span>
                    <div class="comparison-statistics">
                        <span class="red-square"></span>
                        <span class="red-text">Bad result</span>
                    </div>
                </div>
            </div>
            <div class="profiling_reports">
                <div class="profiling__header-title">Sum statistics lead time CPU:</div>
                <div class="profiling-reports_items">
                    <div class="comparison-statistics_wrap" data-comparison="*%">
                        <div class="comparison-statistics">
                            <span class="green-square"></span>
                            <span class="green-text">+<?=$diffCommonReplaced['added']['cpu']; ?> ms <br>+<?=$diffCommonReplaced['added']['cpu'] / 1e+6;?> s</span>
                        </div>
                        <div class="comparison-statistics">
                            <span class="red-square"></span>
                            <span class="red-text"><?=$diffCommonReplaced['removed']['cpu']; ?> ms <br><?=$diffCommonReplaced['removed']['cpu'] / 1e+6;?> s</span>
                        </div>
                    </div>
                    <span class="report_sum-text">Comparison report:</span>
                    <div class="comparison-statistics">
                        <span class="green-square"></span>
                        <span class="green-text">Excellent result</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="profiling__content">
            <table class="profiling_table">
                <thead class="profiling-table_head">
                    <th>Name</th>
                    <th>Calls</th>
                    <th>Lead time</th>
                    <th>Lead time CPU</th>
                    <th>Actions</th>
                </thead>
                <tbody class="profiling-table_body">
                    <?php foreach ($diffReport as $hashName => $data): ?>
                    <tr>
                        <td><?=$hashName;?></td>
                        <td>
                            <?=$data['ct']['was'];?>
                            (<span class="<?=$data['ct']['changed'] <= 0 ? 'red-text' : 'green-text';?>">
                                <?=$data['ct']['changed'] < 0 ? $data['ct']['changed'] : '+'.$data['ct']['changed']; ?>
                            </span>)
                        </td>
                        <td>
                            <?=$data['wt']['was'];?>
                            (<span class="<?=$data['wt']['changed'] <= 0 ? 'red-text' : 'green-text';?>">
                                <?=$data['wt']['changed'] < 0 ? $data['wt']['changed'] : '+'.$data['wt']['changed']; ?>
                            </span>) ms
                        </td>
                        <td>
                            <?=$data['cpu']['was'];?>
                            (<span class="<?=$data['cpu']['changed'] <= 0 ? 'red-text' : 'green-text';?>">
                                <?=$data['cpu']['changed'] < 0 ? $data['cpu']['changed'] : '+'.$data['cpu']['changed']; ?>
                            </span>) ms
                        </td>
                        <td class="function_actions">
                            <a href="#" class="function_action green">Open</a>
                            <a href="#" class="function_action blue">More details</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php endif; ?>


<!--Scripts-->
<script>
    <?php echo file_get_contents(__DIR__.'/../js/profiler.js'); ?>
</script>
</body>
</html>