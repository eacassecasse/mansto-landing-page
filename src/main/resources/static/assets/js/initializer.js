/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

(function ($) {
    $(document).ready(() => {

        //Testimonial Carousel
        var owl = $('.owl-carousel');

        //Initializes the carousel
        owl.owlCarousel({
            autoplay: true,
            loop: true,
            items: 3,
            center: true,
            smartSpeed: 3000,
            responsive: {
                0: {
                    items: 3
                },

                576: {
                    items: 3
                },

                768: {
                    items: 5
                }
            }
        });

        //Testimonial comments
        var comments = [
            'More Satisfying than be Joseph Gonzalez everday',
            'More Satisfying than be Nora Hulton everday',
            'More Satisfying than be Anastasia Vityukova everday',
            'More Satisfying than be Art Hauntington everday',
            'More Satisfying than be Austin Wade everday'
        ];

        //Testimonial names
        var names = ['Joseph Gonzalez', 'Nora Hulton', 'Anastasia Vityukova',
            'Art Hauntington', 'Austin Wade'];

        //Testimonial jobs
        var positions = ['Microsoft Store', 'Apple Store', 'Play Store', 'Galeria', 'Alibaba'];

        //Changes the comments, names and jobs of the testimonial based on the 
        //change event of carousel
        //Because of the clone property of owl-carousel its elements start at [3] position
        //So to obtain the position[0] it must be done minus 3 positions


        $('#testimonial__comment').text(comments[0]);
        $('#testimonial__description--name').text(names[0]);
        $('#testimonial__description--position').text(positions[0]);

        owl.on('changed.owl.carousel', (event) => {
            $('#testimonial__comment').text(comments[event.item.index - 3]);
            $('#testimonial__description--name').text(names[event.item.index - 3]);
            $('#testimonial__description--position').text(positions[event.item.index - 3]);
        });

        if ($(document).width() >= 768) {

            owl.on('changed.owl.carousel', (event) => {
                $('#testimonial__comment').text(comments[event.item.index - 5]);
                $('#testimonial__description--name').text(names[event.item.index - 5]);
                $('#testimonial__description--position').text(positions[event.item.index - 5]);
            });
        }

    });
})(jQuery);

