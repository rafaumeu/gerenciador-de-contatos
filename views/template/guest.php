<!DOCTYPE html>
<html lang="pt-BR" data-theme="black">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Schibsted+Grotesk:ital,wght@0,400;0,500;0,700;1,400&display=swap"
    rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Gerenciador de Contatos</title>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { sans: ['"Schibsted Grotesk"', 'sans-serif'] },
          fontSize: {
            'heading': ['24px', '32px'],
            'text-large': ['16px', '24px'],
            'text-medium': ['14px', '22px'],
            'text-small': ['12px', '20px'],
            'text-xsmall': ['10px', '14px'],
            'label-medium': ['14px', '22px'],
            'label-small': ['12px', '20px'],
          },
          colors: {
            background: { primary: "#111111", secondary: "#1b1b1b", tertiary: "#303030" },
            border: { primary: "#303030" },
            content: { primary: "#ffffff", body: "#e2e2e2", heading: "#c6c6c6", muted: "#5e5e5e", placeholder: "#777777", inverse: "#111111" },
            accent: { brand: "#c4f120", red: "#e61e32" },
          }
        }
      }
    }
  </script>
</head>

<body class="min-h-screen h-[calc(100vh-4rem)] flex bg-background-primary font-sans text-content-body antialiased">
  <div class="hidden lg:flex w-1/2 h-full relative overflow-hidden bg-background-secondary items-center justify-center">
    <img src="/assets/bg-guest.png" alt="Imagem de ilustração"
      class="w-full h-full object-cover absolute inset-0 opacity-80">
    <div class="absolute inset-0 bg-gradient-to-t from-background-primary/90 to-transparent"></div>
    <div class="absolute top-[50px] left-[98px] z-10 flex flex-row items-center gap-4">
      <img src="/assets/logo.svg" alt="Logo" class="w-[28px] h-[28px] drop-shadow-[0_0_20px_rgba(196,241,32,0.4)]">
      <h1 class="text-heading font-bold text-content-primary uppercase">
        Guard
      </h1>
    </div>
  </div>
  <div class="w-full lg:w-1/2 h-full flex felx-col items-center justify-center p-8 lg:p-16">
    <div class="w-full max-w-[420px] flex flex-col gap-8">
      <?= $content ?>
    </div>
  </div>
</body>

</html>