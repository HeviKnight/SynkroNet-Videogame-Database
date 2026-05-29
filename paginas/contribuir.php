<?php
$base_url = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
$base_url = str_replace('/paginas', '', $base_url);
include_once('../componentes/sidebar.php');
?>

    <!-- HEADER WITH GRADIENT TITLE -->
    <header class="header-games">
        <h1 class="header-games-title">CONTRIBUIR</h1>
    </header>

    <section id="main-content" class="main-content">
        <main id="home">
            <!-- CONTRIBUTE SECTION -->
            <section class="section-B">
                <div class="card-content container">
                    <div class="row g-4">
                        <!-- LEFT SIDE: MENU -->
                        <div class="col-lg-3 col-md-4 d-none d-md-block">
                            <div style="display: flex; flex-direction: column; gap: 8px;">
                                <div style="background: linear-gradient(135deg, #16c9c9 0%, #0a9eb7 100%); padding: 12px 16px; border-radius: 25px; color: white; cursor: pointer; text-align: center; font-weight: 500; font-size: 14px;">General</div>
                                <div style="background: rgba(22, 201, 201, 0.2); padding: 12px 16px; border-radius: 25px; color: var(--text-main); cursor: pointer; border: 1px solid var(--border-sky); text-align: center; font-size: 14px;">Localización</div>
                                <div style="background: rgba(22, 201, 201, 0.2); padding: 12px 16px; border-radius: 25px; color: var(--text-main); cursor: pointer; border: 1px solid var(--border-sky); text-align: center; font-size: 14px;">Nombres Alternativos</div>
                                <div style="background: rgba(22, 201, 201, 0.2); padding: 12px 16px; border-radius: 25px; color: var(--text-main); cursor: pointer; border: 1px solid var(--border-sky); text-align: center; font-size: 14px;">Categorías</div>
                                <div style="background: rgba(22, 201, 201, 0.2); padding: 12px 16px; border-radius: 25px; color: var(--text-main); cursor: pointer; border: 1px solid var(--border-sky); text-align: center; font-size: 14px;">Lanzamiento</div>
                                <div style="background: rgba(22, 201, 201, 0.2); padding: 12px 16px; border-radius: 25px; color: var(--text-main); cursor: pointer; border: 1px solid var(--border-sky); text-align: center; font-size: 14px;">Creadores</div>
                                <div style="background: rgba(22, 201, 201, 0.2); padding: 12px 16px; border-radius: 25px; color: var(--text-main); cursor: pointer; border: 1px solid var(--border-sky); text-align: center; font-size: 14px;">Webs</div>
                                <div style="background: rgba(22, 201, 201, 0.2); padding: 12px 16px; border-radius: 25px; color: var(--text-main); cursor: pointer; border: 1px solid var(--border-sky); text-align: center; font-size: 14px;">Catálogo</div>
                                <div style="background: rgba(22, 201, 201, 0.2); padding: 12px 16px; border-radius: 25px; color: var(--text-main); cursor: pointer; border: 1px solid var(--border-sky); text-align: center; font-size: 14px;">Historia</div>
                                <div style="background: rgba(22, 201, 201, 0.2); padding: 12px 16px; border-radius: 25px; color: var(--text-main); cursor: pointer; border: 1px solid var(--border-sky); text-align: center; font-size: 14px;">Ficha técnica</div>
                                <div style="background: rgba(22, 201, 201, 0.2); padding: 12px 16px; border-radius: 25px; color: var(--text-main); cursor: pointer; border: 1px solid var(--border-sky); text-align: center; font-size: 14px;">Rating de edad</div>
                                <div style="background: rgba(22, 201, 201, 0.2); padding: 12px 16px; border-radius: 25px; color: var(--text-main); cursor: pointer; border: 1px solid var(--border-sky); text-align: center; font-size: 14px;">Idiomas soportados</div>
                                <div style="background: rgba(22, 201, 201, 0.2); padding: 12px 16px; border-radius: 25px; color: var(--text-main); cursor: pointer; border: 1px solid var(--border-sky); text-align: center; font-size: 14px;">Links de navegación</div>
                                <div style="background: rgba(22, 201, 201, 0.2); padding: 12px 16px; border-radius: 25px; color: var(--text-main); cursor: pointer; border: 1px solid var(--border-sky); text-align: center; font-size: 14px;">Tráiler/Webgame</div>
                            </div>

                            <!-- CONTRIBUTE INFO BOX -->
                            <div style="background: linear-gradient(135deg, #16c9c9 0%, #0a9eb7 100%); padding: 16px; border-radius: 15px; color: white; margin-top: 20px;">
                                <h3 style="margin: 0 0 12px 0; font-size: 15px; font-weight: bold;">Como contribuir</h3>
                                <p style="margin: 0; font-size: 12px; line-height: 1.5;">Here you can change the information of this specific game. You will be rewarded karma points for your efforts. The data you enter will be validated by admins or moderators.</p>
                            </div>
                        </div>

                        <!-- RIGHT SIDE: FORM -->
                        <div class="col-lg-9 col-md-8 col-12">
                            <!-- EMAIL SECTION -->
                            <div style="background: linear-gradient(135deg, #16c9c9 0%, #0a9eb7 100%); padding: 20px; border-radius: 12px; margin-bottom: 20px;">
                                <div style="display: flex; align-items: center; gap: 15px; flex-wrap: wrap;">
                                    <div style="flex: 1; min-width: 200px;">
                                        <label style="display: block; color: white; font-size: 13px; margin-bottom: 8px;">Email</label>
                                        <input type="email" class="form-control" placeholder="you@example.com" style="background: white; border: none; color: #333; padding: 10px 12px;">
                                    </div>
                                    <button class="btn btn-dark" style="padding: 10px 24px; height: fit-content; align-self: flex-end;">Submit</button>
                                </div>
                            </div>

                            <!-- GENERAL FORM SECTION -->
                            <div style="background: linear-gradient(135deg, #16c9c9 0%, #0a9eb7 100%); padding: 20px; border-radius: 12px;">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label style="display: block; color: white; font-size: 13px; margin-bottom: 8px;">Name</label>
                                        <input type="text" class="form-control" placeholder="Value" style="background: white; border: none; color: #333; padding: 10px 12px;">
                                    </div>
                                    <div class="col-12">
                                        <label style="display: block; color: white; font-size: 13px; margin-bottom: 8px;">Surname</label>
                                        <input type="text" class="form-control" placeholder="Value" style="background: white; border: none; color: #333; padding: 10px 12px;">
                                    </div>
                                    <div class="col-12">
                                        <label style="display: block; color: white; font-size: 13px; margin-bottom: 8px;">Email</label>
                                        <input type="email" class="form-control" placeholder="Value" style="background: white; border: none; color: #333; padding: 10px 12px;">
                                    </div>
                                    <div class="col-12">
                                        <label style="display: block; color: white; font-size: 13px; margin-bottom: 8px;">Message</label>
                                        <textarea class="form-control" rows="6" placeholder="Value" style="background: white; border: none; color: #333; padding: 10px 12px; resize: vertical;"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-dark w-100" style="padding: 12px 16px; font-weight: 500;">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- NORMATIVA SECTION -->
            <section class="section-B" style="margin-top: 30px;">
                <div class="card-content container">
                    <div style="background: linear-gradient(135deg, #16c9c9 0%, #0a9eb7 100%); padding: 20px; border-radius: 12px; color: white;">
                        <h2 style="margin: 0 0 15px 0; font-size: 18px; font-weight: bold;">Normativa</h2>
                        <div style="font-size: 13px; line-height: 1.6;">
                            <p style="margin: 0 0 8px 0;"><strong>Términos de Uso:</strong> Al contribuir a SynkroNET, aceptas nuestros términos de servicio.</p>
                            <p style="margin: 0 0 8px 0;"><strong>Política de Privacidad:</strong> Tu información será tratada conforme a nuestra política de privacidad.</p>
                            <p style="margin: 0 0 8px 0;"><strong>Contenido:</strong> El contenido debe ser preciso, legal y respetuoso con los derechos de terceros.</p>
                            <p style="margin: 0 0 8px 0;"><strong>Moderación:</strong> Los contenidos serán revisados y moderados por el equipo de administración.</p>
                            <p style="margin: 0;"><strong>Sanciones:</strong> El incumplimiento de estas normas puede resultar en la eliminación de contenido o restricción de cuenta.</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </section>

<?php
include_once("../componentes/footer.php");
?>
