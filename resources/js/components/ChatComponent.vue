<template>
    <div>
        <div class="container-fluid h-100">
			<div class="row justify-content-center h-100">
				
				<div class="col-md-12  chat">
					<div class="card">
						<div class="card-header msg_head">
							<div class="d-flex bd-highlight">
								<div class="img_cont">
									<img src="images/alfredo-uribe-pic.jpg" class="rounded-circle user_img">
									<span class="online_icon"></span>
								</div>
								<div class="user_info">
									<span>Alfredo Uribe's Bot</span>
								</div>

							</div>
							<span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
							<div class="action_menu">
								<ul>
									<li><i class="fas fa-user-circle"></i> View profile</li>
									<li><i class="fas fa-users"></i> Add to close friends</li>
									<li><i class="fas fa-plus"></i> Add to group</li>
									<li><i class="fas fa-ban"></i> Block</li>
								</ul>
							</div>
						</div>
						<div class="card-body msg_card_body">

                            <div v-for="(item, index) in responses" :key="index">

                                <div class="d-flex justify-content-start mb-4" v-if='item.origin=="chat"'>
                                    <div class="img_cont_msg">
                                        <img src="images/alfredo-uribe-pic.jpg" class="rounded-circle user_img_msg">
                                    </div>
                                    <div class="msg_cotainer">
                                        {{ item.content }}
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end mb-4" v-else>
                                    <div class="msg_cotainer_send">
                                        {{ item.content }}
                                    </div>
                                    <div class="img_cont_msg">
                                        <img src="/images/user-profile.png" class="rounded-circle user_img_msg">
                                    </div>
                                </div>

                            </div>

						</div>
						<div class="card-footer">
							<div class="input-group">
								
								

                                <form @submit.prevent="submitMessage" style="width: 85%;">
								    <input type="text" name="" v-model="message" class="form-control type_msg" placeholder="Type your message...">
                                </form>
								<div class="input-group-append">
									<span class="input-group-text send_btn" @click="submitMessage" @keypress.enter="submitMessage"><i class="fas fa-location-arrow"></i></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

    </div>
</template>

<script>
import { assertExpressionStatement } from '@babel/types';
import nlp from 'compromise';
const knowledgeBase = [
    { question: 'profesion', answer: 'Soy desarrollador de software' },
    { question: 'En que industria trabajas?', answer: 'Trabajo en la industria de la tecnología' },
    { question: '¿Cuáles son tus habilidades?', answer: 'Tengo habilidades en desarrollo de software, inteligencia artificial y procesamiento de lenguaje natural' },
    { question: 'about', answer: 'Alfredo Uribe. Computer Science Professional with 10 years of experience successfully delivering End to End web applications to small, medium and large companies of several business models. Experienced with HTML5, CSS3, jQuery, JavaScript, AJAX, MVC, Bootstrap, Git, MySQL, Angular, TS, Vue and PHP. I am looking forward to digitally transforming organizations with state of the art technologies' },
    { question: 'what about', answer: 'Alfredo Uribe. Computer Science Professional with 10 years of experience successfully delivering End to End web applications to small, medium and large companies of several business models. Experienced with HTML5, CSS3, jQuery, JavaScript, AJAX, MVC, Bootstrap, Git, MySQL, Angular, TS, Vue and PHP. I am looking forward to digitally transforming organizations with state of the art technologies' },
    { question: 'what about you', answer: 'Alfredo Uribe. Computer Science Professional with 10 years of experience successfully delivering End to End web applications to small, medium and large companies of several business models. Experienced with HTML5, CSS3, jQuery, JavaScript, AJAX, MVC, Bootstrap, Git, MySQL, Angular, TS, Vue and PHP. I am looking forward to digitally transforming organizations with state of the art technologies' },
    { question: 'talk to me about', answer: 'Alfredo Uribe. Computer Science Professional with 10 years of experience successfully delivering End to End web applications to small, medium and large companies of several business models. Experienced with HTML5, CSS3, jQuery, JavaScript, AJAX, MVC, Bootstrap, Git, MySQL, Angular, TS, Vue and PHP. I am looking forward to digitally transforming organizations with state of the art technologies' },
    { question: 'tell me about', answer: 'Alfredo Uribe. Computer Science Professional with 10 years of experience successfully delivering End to End web applications to small, medium and large companies of several business models. Experienced with HTML5, CSS3, jQuery, JavaScript, AJAX, MVC, Bootstrap, Git, MySQL, Angular, TS, Vue and PHP. I am looking forward to digitally transforming organizations with state of the art technologies' },

    // Agrega más preguntas y respuestas según sea necesario
];
export default {
    data() {
        return {
            message: '',
            responses: [],
			knowledgeBase: []
        };
    },
    methods: {
        submitMessage() {
            // Use the compromise library to process the message
            const result = nlp(this.message);
            // console.log(result)
            // console.log(result.verbs())
            // console.log(result.verbs().toPast().text())

            // console.log(result.terms())


            // Check the knowledge base for a matching question using regular expressions
            for (let i = 0; i < this.knowledgeBase.length; i++) {
                //const match = result.match(knowledgeBase[i].question).length;
                const match = nlp(this.knowledgeBase[i].question).match(this.message).length
                // console.log(nlp(knowledgeBase[i].question).match(this.message))
                if (match > 0) {
                    let message = {
                        'origin': 'user',
                        'content': this.message
                    }
                    this.responses.push(message);
                    message = {
                        'origin': 'chat',
                        'content': this.knowledgeBase[i].answer
                    }
                    this.responses.push(message);
                    this.message = '';

                    setTimeout(function(){
                        $('.msg_card_body').scrollTop($('.msg_card_body')[0].scrollHeight);
                    }, 500)
                    

                    return;
                }
            }

            // If no matching question is found, return a default response
            let message = {
                'origin': 'user',
                'content': this.message
            }
            this.responses.push(message);

            message = {
                'origin': 'chat',
                'content': 'I am sorry if I can not understand, I am still being trained'
            }
            this.responses.push(message);

            // Clear the input field
            this.message = '';
            setTimeout(function(){
                $('.msg_card_body').scrollTop($('.msg_card_body')[0].scrollHeight);
            }, 500)
        },
		getKnowledge(){
			axios.get('api/get_answers_front').
			then( res => {
				this.knowledgeBase = res.data
			})
		}

    },
	mounted(){
		this.getKnowledge()
	}
};

$(document).ready(function(){
    $('#action_menu_btn').click(function(){
        $('.action_menu').toggle();
    });
});
</script>


<style scoped>
	.chat{
			margin-top: auto;
			margin-bottom: auto;
		}
		.card{
			height: 500px;
			border-radius: 15px !important;
			background-color: rgba(0,0,0,0.4) !important;
		}
		.contacts_body{
			padding:  0.75rem 0 !important;
			overflow-y: auto;
			white-space: nowrap;
		}
		.msg_card_body{
			overflow-y: auto;
		}
		.card-header{
			border-radius: 15px 15px 0 0 !important;
			border-bottom: 0 !important;
		}
	 .card-footer{
		border-radius: 0 0 15px 15px !important;
			border-top: 0 !important;
	}
		.container{
			align-content: center;
		}
		.search{
			border-radius: 15px 0 0 15px !important;
			background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color:white !important;
		}
		.search:focus{
		     box-shadow:none !important;
           outline:0px !important;
		}
		.type_msg{
			background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color:white !important;
			height: 60px !important;
			overflow-y: auto;
		}
			.type_msg:focus{
		     box-shadow:none !important;
           outline:0px !important;
		}
		.attach_btn{
	border-radius: 15px 0 0 15px !important;
	background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color: white !important;
			cursor: pointer;
		}
		.send_btn{
	border-radius: 0 15px 15px 0 !important;
	background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color: white !important;
			cursor: pointer;
		}
		.search_btn{
			border-radius: 0 15px 15px 0 !important;
			background-color: rgba(0,0,0,0.3) !important;
			border:0 !important;
			color: white !important;
			cursor: pointer;
		}
		.contacts{
			list-style: none;
			padding: 0;
		}
		.contacts li{
			width: 100% !important;
			padding: 5px 10px;
			margin-bottom: 15px !important;
		}
	.active{
			background-color: rgba(0,0,0,0.3);
	}
		.user_img{
			height: 70px;
			width: 70px;
			border:1.5px solid #f5f6fa;
		
		}
		.user_img_msg{
			height: 40px;
			width: 40px;
			border:1.5px solid #f5f6fa;
		
		}
	.img_cont{
			position: relative;
			height: 70px;
			width: 70px;
	}
	.img_cont_msg{
			height: 40px;
			width: 40px;
	}
	.online_icon{
		position: absolute;
		height: 15px;
		width:15px;
		background-color: #4cd137;
		border-radius: 50%;
		bottom: 0.2em;
		right: 0.4em;
		border:1.5px solid white;
	}
	.offline{
		background-color: #c23616 !important;
	}
	.user_info{
		margin-top: auto;
		margin-bottom: auto;
		margin-left: 15px;
	}
	.user_info span{
		font-size: 20px;
		color: white;
	}
	.user_info p{
	font-size: 10px;
	color: rgba(255,255,255,0.6);
	}
	.video_cam{
		margin-left: 50px;
		margin-top: 5px;
	}
	.video_cam span{
		color: white;
		font-size: 20px;
		cursor: pointer;
		margin-right: 20px;
	}
	.msg_cotainer{
		margin-top: auto;
		margin-bottom: auto;
		margin-left: 10px;
		border-radius: 25px;
		background-color: #82ccdd;
		padding: 10px;
		position: relative;
	}
	.msg_cotainer_send{
		margin-top: auto;
		margin-bottom: auto;
		margin-right: 10px;
		border-radius: 25px;
		background-color: #78e08f;
		padding: 10px;
		position: relative;
	}
	.msg_time{
		position: absolute;
		left: 0;
		bottom: -15px;
		color: rgba(255,255,255,0.5);
		font-size: 10px;
	}
	.msg_time_send{
		position: absolute;
		right:0;
		bottom: -15px;
		color: rgba(255,255,255,0.5);
		font-size: 10px;
	}
	.msg_head{
		position: relative;
	}
	#action_menu_btn{
		position: absolute;
		right: 10px;
		top: 10px;
		color: white;
		cursor: pointer;
		font-size: 20px;
	}
	.action_menu{
		z-index: 1;
		position: absolute;
		padding: 15px 0;
		background-color: rgba(0,0,0,0.5);
		color: white;
		border-radius: 15px;
		top: 30px;
		right: 15px;
		display: none;
	}
	.action_menu ul{
		list-style: none;
		padding: 0;
	margin: 0;
	}
	.action_menu ul li{
		width: 100%;
		padding: 10px 15px;
		margin-bottom: 5px;
	}
	.action_menu ul li i{
		padding-right: 10px;
	
	}
	.action_menu ul li:hover{
		cursor: pointer;
		background-color: rgba(0,0,0,0.2);
	}
	@media(max-width: 576px){
	.contacts_card{
		margin-bottom: 15px !important;
	}
	}
</style>