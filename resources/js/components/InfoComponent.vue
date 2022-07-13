<template>
    <div style="padding-top: 20px" >
        <img src="images/alfredo-uribe-3.jpg" class="profilePicture" width="100px" height="100px"  alt="Alfredo Uribe">
        <br>
        <h2 style="font-size:12px; padding-top: 20px" class="text-center">Alfredo Uribe</h2>
        <h3 style="font-size:12px;" class="text-center">Fullstack Web Developer</h3>

        <div class="row text-center social-list">
            <div class="col-3">
                <a href="https://www.facebook.com/alfredouribedeveloper" target="_blank"><i class="fa-brands fa-facebook"></i></a>
            </div>

            <div class="col-3">
                <a href="https://www.youtube.com/channel/UC00IFys9tNhSiGqVEWGLAOQ" target="_blank"><i class="fa-brands fa-youtube"></i></a>
            </div>
                
            <div class="col-3">
                <a href="https://www.linkedin.com/in/francisco-alfredo-uribe-s%C3%A1nchez-40a748b7/" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
            </div>
            
            <div class="col-3">
                <a href="https://play.google.com/store/apps/details?id=com.alfredouribe" target="_blank"><i class="fa-brands fa-google-play"></i></a>
            </div>

        </div>

        <p class="borderTop text-center" style="padding-top: 10px; display: none">
            I am Web Developer that loves programming and learn more about other technologies.
        </p>

        <p class="borderTop text-center" style="padding-top: 10px; display: none">
            I lead projects from scratch to production deploy guiding teams with agile methodology and acting as a scrum master.
        </p>



        

    </div>
</template>

<script>
    export default {
        mounted() {
            
        }
    }
</script>

<style scoped>
    .profilePicture{
        width: 100%;
        height: 100%;
    }

    .social-list{
        margin-bottom: 20px;
        margin-top: 20px;
    }
    .social-list i{
        font-size: 20px
    }
</style>
