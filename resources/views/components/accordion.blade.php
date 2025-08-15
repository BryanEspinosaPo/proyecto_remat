@props([
    'single' => false,
    'id' => Str::uuid(),
])

<section class="preguntas-frecuentes">
    <div class="container">
        <div class="contenedor-titulo-preguntas">
            <h2>Preguntas Frecuentes</h2>
        </div>

        <div class="contenedor-general-acordeones">
            <div class="accordion" data-accordion="{{ $single ? 'single' : 'multiple' }}"
                id="accordion-{{ $id }}">
                {{ $slot }}
            </div>
        </div>
    </div>

    </div>
</section>
