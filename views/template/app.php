<?php
Core\Session::init();
$uri = $_SERVER['REQUEST_URI'] ?? '/';
function getLinkClasses($rota, $uriAtual): string
{
    $base = 'group relative flex items-center justify-center p-3 rounded-xl transition-all duration-300';
    $ativo = 'bg-background-tertiary text-accent-brand';
    $inativo = 'bg-background-secondary text-content-muted hover:text-accent-brand hover:bg-accent-brand/5';

    return $uriAtual == $rota ? "$base $ativo" : "$base $inativo";
}
?>
<!DOCTYPE html>
<html lang="pt-BR" data-theme="black">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Schibsted+Grotesk:ital,wght@0,400;0,500;0,700;1,400&display=swap"
    rel="stylesheet">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.2/dist/full.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
  <title>Gerenciador de Contatos</title>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['"Schibsted Grotesk"', 'sans-serif']
          },
          fontSize: {
            'heading': ['24px', '32px'],
            'text-large': ['16px', '24px'],
            'text-medium': ['14px', '22px'],
            'text-small': ['12px', '20px'],
            'text-xsmall': ['10px', '14px'],
            'label-medium': ['14px', '22px'],
            'label-small': ['12px', '20px'],
            'modal-heading': ['20px', '28px'],
            'icon': ['16px']
          },
          colors: {
            background: {
              primary: "#111111",
              secondary: "#1b1b1b",
              tertiary: "#303030",
            },
            border: {
              primary: "#303030",
            },
            content: {
              primary: "#ffffff",
              body: "#e2e2e2",
              heading: "#c6c6c6",
              muted: "#5e5e5e",
              placeholder: "#777777",
              inverse: "#111111",
            },
            accent: {
              brand: "#c4f120",
              red: "#e61e32",
            },
          }
        }
      },
      daisyui: {
        themes: [
          {
            gerenciador: {
              "primary": "#A3E635",
              "secondary": "#27272A",
              "accent": "#d9f99d",
              "neutral": "#18181b",
              "base-100": "#09090b",
              "base-200": "#121212",
              "info": "#3abff8",
              "success": "#A3E635",
              "warning": "#fbbd23",
              "error": "#f87272",
            },
          },
        ],
      },
    }
  </script>
  <style>
    .hide-scrollbar::-webkit-scrollbar {
      display: none;
    }
    .hide-scrollbar {
      -ms-overflow-style: none;
      scrollbar-width: none;
    }
  </style>
</head>

<body class="min-h-screen bg-background-primary font-sans text-base-content flex flex-row antialiased">
  <aside
    class="flex flex-col items-center w-[111px] gap-[222px] py-8 ml-[36px] mt-[46px] mb-[4 mr-[25px] border-r border-background-secondary/20 backdrop-blur-sm">
    <a href="/" class="hover:scale-110 transition-transform duration-300">
      <img src="/assets/logo.svg" class="w-8 h-8 drop-shadow-[0_0_10px_rgba(163,230,53,0.5)]" alt="Logo">
    </a>
    <nav class="flex flex-col gap-[12px] items-start w-[50px]">
      <a href="/"
        class="<?= getLinkClasses('/', $uri) ?>">
        <span class="material-symbols-rounded text-2xl">
          account_circle
        </span>
      </a>
      
      <a href="/contatos"
        class="<?= getLinkClasses('/contatos', $uri) ?>">
        <span class="material-symbols-rounded text-2xl">
          settings
        </span>
      </a>
      <form action="/logout" method="post">
        <button type="submit"
          class="group relative flex items-center bg-background-secondary justify-center p-3 rounded-xl text-content-muted">
          <span class="material-symbols-rounded text-2xl">
            logout
          </span>
        </button>
      </form>
    </nav>
    <div class="flex flex-col justify-center mt-[60px] w-full text-center">
      <span class="text-content-muted text-label-small">Logado como:</span>
      <span class="text-content-body text-label-small font-bold truncate max-w-[90px] block mx-auto" title="<?= user()['email'] ?? '' ?>"><?= user()['email'] ?? '' ?></span>
    </div>
  </aside>
  <main class="flex-1 w-full max-w-[calc(100vw-250px)] overflow-y-auto bg-background-primary mt-[96px] min-h-[calc(100vh-140px)]">
    <?php if ($msg = flash('success')) { ?>
      <div class="bg-accent-brand/10 border border-accent-brand/20 text-accent-brand px-4 py-3 rounded-xl mb-5 flex items-center gap-2 animate-fade-in-down">
        <span class="material-symbols-rounded text-sm">check_circle</span>
        <span class="font-bold text-sm"><?= $msg ?></span>
      </div>
    <?php } ?>
      <div class="p-[40px] bg-background-secondary rounded-xl h-[calc(100vh-150px)]"> <?= $content ?></div>
  </main>
</body>

</html>