<?php
/*
Template Name: О проекте
*/
?>

<?php get_header(); ?>

		<style> 
				h1 {
				text-transform: uppercase;
				text-align: center;
				color: #333;
				margin: 0 0 60px 0;
				letter-spacing: 4px;
				font: 2.5rem;
				position: relative;
				}
				.author__container {
				display: flex;
				flex-direction: column;
				justify-content: center;
				align-items: center;
				font-size: 1.2rem;
				color: #444;
				padding-bottom: 4rem;
				}
				.author__body p:not(:last-child) {
				margin-bottom: 1.1em;
				}
				.author__body a {
				display: inline-block;
				color: #444;
				text-decoration: none;
				margin: 5px auto;
				}
				.author__body a::after {
				content: '';
				width: 0;
				background-color: #444;
				display: block;
				height: 2px;
				transition: width 0.3s cubic-bezier(0.4, 0.04, 0.98, 0.335);
				}
				.author__body a:hover::after {
				width: 100%;
				}
				.back-arrow a i {
				font-size: 32px;
				position: absolute;
				top: 5%;
				left: 5%;
				}
				.back-arrow a:link,
				.back-arrow a:visited  {
				color: #044453;
				transition: all 0.2s ease-in-out;
				}
				.back-arrow a:hover {
				color: #999;
				}
				.back-arrow a:active {
				color: #000;
				}
				.page {
					margin-top: 100px;
				}
		</style>
         <main class="page">
            <div class="page__author author">
               <div class="author__container">
                  <h1 class="author__title">О проекте</h1>
                  <div class="author__body">
                     <p>
                        <table>
                           <tr>
                              <td>
                                 <b>Об авторах:</b>
                              </td>
                              <td>Машенков Тимофей Михайлович, ученик 11Б класса МАОУ "СОШ №6" </td>
                           </tr>
                           <tr>
                              <td>
                              </td>
                              <td>
                                 Тихонов Александр Валентинович, ученик 10А класса МАОУ "ГГ № 8" 
                              </td>
                           </tr>
                           <tr>
                              <td>
                              </td>
                              <td>
                                 Редин Владислав Владимирович, ученик 9А класса МАОУ "СОШ № 23" 
                              </td>
                           </tr>
                        </table>
                        
                     
                     </p>
                     <p>
                        <b>Руководитель проекта:</b> Прилучная Ольга Николаевна
                     </p>
                     <p>
                        <b>Использованные инструменты:</b><br>
                        - Figma <br>
                        - VS Code <br>
                        - Различные браузеры <br>
                        - Сервера "Северного Кванториума", GitHub <br>
                     </p>
                     <p>
                        <b>Примененные технологии:</b> <br>
                        - <a target="_blank" href="https://owlcarousel2.github.io/OwlCarousel2/">
                           OwlCarousel.js
                        </a> <br>
                        - <a target="_blank" href="https://necolas.github.io/normalize.css/">
                           Normalize.css
                        </a> <br>
                        - <a target="_blank" href="https://fontawesome.com/?ref=webspasm">
                           FontAwesome
                        </a> <br>
                        - <a target="_blank" href="https://www.kunkalabs.com/mixitup/">
                        	MixItUp.js
                        </a> <br>
                        - <a target="_blank" href="https://www.lightgalleryjs.com/">
                        	LightGalley.js
                        </a> <br>
                     </p>
                  </div>
               </div>
            </div>
         </main>

<?php get_footer(); ?>