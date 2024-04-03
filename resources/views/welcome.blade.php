<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>To Do List</title>

        <!-- Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Nunito' rel='stylesheet'>
        <link href="https://unpkg.com/tailwindcss@2/dist/tailwind.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
        <!-- Styles -->
        <style>
body { 
    font-family: 'Nunito', sans-serif; 
    background-color: #2C3E50; 
    color: #F1C40F; 
    display: flex; 
    justify-content: center; 
    align-items: center; 
 }

@keyframes fadeIn {
    0% {
        opacity: 0; 
    }
    100% {
        opacity: 1; 
    }
}

@keyframes bounce {
    0% {
        transform: translateY(0);
    }
    100% {
        transform: translateY(-10px);
    }
}

.fade-in {
    animation-name: fadeIn;
    animation-duration: 1s;
    animation-timing-function: ease-in-out;
}

.emoji-button {
    font-size: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: bounce 1s infinite alternate;
}

form {
    background-color: #00000000;
    border-radius: 5px;
    padding: 20px;
    color: #F1C40F;
    max-width: 700px;
    margin: 0 auto; 

}

input[type="text"] {
    border: 1px solid #707070;    
}

button {
    background-color:#fbbc05;
    color: #272727; 
    border: none;
    border-radius: 5px;
    padding: 5px 10px;
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.8);
}


.isDone {
    background-color: #00000000;
    border-radius: 5px;
    padding: 5px;
    color: #00000000; 
}

.taskDelete {
    background-color:#00000000; 
    border-radius: 5px;
    padding: 5px;
    color: #00000000;
}

#add_button {
    background-color: #fbbc05;
    display: block; 
    margin: 0 auto; 
    box-shadow: 0 0 8px rgba(235, 151, 3, 0.6);
    text-align: center;     
}
#add_button2 {
    background-color: #fbbc05;
    display: block; 
    margin: 0 auto; 
    box-shadow: 0 0 8px rgba(235, 151, 3, 0.6);
    text-align: center;   
    width: 100%;  
}

.bg-custom-green {
  background-color: #34a853;
}
.bg-custom-black {
  background-color:  #272727;
}
.text-custom-yellow {
  color: #fbbc05;
}
.border-custom-yellow {
  border-color: #fbbc05;
}
.border-custom-white {
  box-shadow: 0px 0px 15px 0px rgba(255,255,255,0.75)
}
.bg-custom-blue {
  background-color:  #46bcde;
}

#myElement {
    max-width: 700px;
    margin: 0 auto;
}
.split-container {
    position: relative;
    overflow: hidden;
}

.split-container {
    position: relative;
    overflow: hidden;
    display: flex;
    width: 100%;
    max-height: 1000px; 
    min-height: 0;
}

.tasks-button {
    cursor: pointer;
    position: absolute;
    top: 50%;
    left: 20px; 
    z-index: 12;
    transform: translateY(-50%);
}

.main-content {
    flex-basis: 100%; 
    transition: 0.5s;
}
.tasks-container {
    position: relative;
    padding-left: 20px;
    flex-basis: 0%; 
    overflow: hidden;
    height: calc(100% - 1rem);
    transition: 0.5s;
    background-color: #F1C40F;
}
.tasks-content {
    overflow-y: auto; 
    height: 100%; 
}

.show-tasks .main-content {
    flex-basis: 40%;
}

.show-tasks .tasks-container {
    flex-basis: 60%;
    overflow-x: auto;
}

.vertical-divider {
    width: 20px;
    height: 100%;
    position: absolute;
    right: -10px;
    z-index: 11;
    background-image: linear-gradient(90deg, rgba(0, 0, 0, 0) 50%, #F1C40F 50%);
} 

.priority-select {
        width: 150px; 
        font-size: 1rem; 
        padding: 5px 10px;
    }
#priority-wrapper{
    text-align: center;
    
}


        </style>
    </head>
    <body class="bg-gray-200 p-4">
        <div class="split-container w-full h-screen lg:mx-auto py-8 px-6 rounded-xl" style="background-color: #272727;">
            
        <div class="main-content">
            <h1 class="font-bold text-5xl text-center mb-8 text-custom-yellow">やることリスト</h1>
            <div class="mb-6">
                <form class="flex flex-col space-y-4" method="POST" action="/">
                    @csrf
                    <input type="text" name="title" placeholder="やることタイトル" class="py-3 px-4 bg-yellow-100 text-black rounded-xl">

                    <textarea name="description" placeholder="やること説明" class="py-3 px-4 bg-yellow-100 text-black rounded-xl"></textarea>
                    <div class="priority-wrapper">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <select name="priority" id="priority-wrapper" class="py-3 px-4 bg-yellow-100 font-bold text-black rounded-xl priority-select" onchange="updateSelectColor(this)">
                        <option value="low">低い</option>
                        <option value="medium">中間</option>
                        <option value="high">高い</option>
                    </select>         
                    </div>           
                    <br>
                    <button class="w-28 py-4 px-8 text-black rounded-xl transition-all duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110 shadow-lg" id="add_button"><b>追加</b></button>
                      
                </form>
            </div> 

        </div>
            <div class="tasks-button">
                <button onclick="toggleTasks()" class="emoji-button w-20 h-20 py-4 px-8 text-black text-center rounded-xl transition-all duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110 shadow-lg flex items-center justify-center" id="add_button2">📝</button>
            </div>
            <div class="vertical-divider"></div>
        
            <div class="tasks-container rounded-xl">
                <div class="tasks-content mt-2 p-4">
                <button onclick="sortTasks()" id="sort_button" class="py-2 px-4 bg-custom-blue text-white font-bold rounded-xl transition-all duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110 shadow-lg mb-4">優先ビュー</button>
                @foreach ($todos as $todo)                
                    <div id="myElement"
                        @class([
                            'py-4 flex items-center border-4 border-custom-white  px-3 text-custom-yellow font-bold fade-in rounded-xl',
                            $todo->isDone ? 'bg-custom-green' : 'bg-custom-black',
                        ])
                    >
                        <div class="flex-1 pr-8">
                            <h3 class="text-lg font-semibold">{{ $todo-> title}}</h3>
                            <p class="text-white">{{ $todo-> description}}</p>
                            <p class="text-white">
                                優先度： 
                                @if ($todo->priority == 'low')
                                    <span style="color: green;">低い</span>
                                @elseif ($todo->priority == 'medium')
                                    <span style="color: orange;">中間</span>
                                @elseif ($todo->priority == 'high')
                                    <span style="color: red;">高い</span>
                                @else
                                    <span>その他</span>
                                @endif
                            </p>                                                       
                        </div>

                        <div class="flex space-x-3">

                            {{-- TASK DONE --}}
                            <form method="POST" action="/{{ $todo-> id}}">
                                @csrf
                                @method('PATCH')
                                <button class="py-2 px-4 bg-green-500 border-green-900 font-bold text-black rounded-xl transition-all duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110 shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                        <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                    </svg>                                                             
                                </button>
                            </form>  

                            {{-- TASK DELETE --}}
                            <form method="POST" action="/{{ $todo-> id}}">
                                @csrf
                                @method('DELETE')
                                <button class="py-2 px-4 bg-red-500 border-red-900 font-bold  text-black rounded-xl transition-all duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110 shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                        <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z" clip-rule="evenodd" />
                                    </svg>                                                     
                                </button>
                            </form>    
                        </div>
                    </div>
                    <br>
                @endforeach
                </div>
            </div>
        </div>
        <script>
       let sortState = 0;

            // Sort tasks function
            function sortTasks() {
                const tasksContainer = document.querySelector(".tasks-content");
                const tasks = Array.from(tasksContainer.querySelectorAll("#myElement"));

                if (sortState === 0) {
                    sortState = 1;
                    tasks.sort((a, b) => {
                        const priorityA = a.querySelector("p:last-child").innerText.split(" ")[1];
                        const priorityB = b.querySelector("p:last-child").innerText.split(" ")[1];
                        const priorities = { "高い": 3, "中間": 2, "低い": 1 };
                        return priorities[priorityB] - priorities[priorityA];
                    });
                } else {
                    sortState = 0;
                    tasks.sort((a, b) => parseInt(a.id) - parseInt(b.id));
                }

                tasksContainer.innerHTML = "";
                tasks.forEach(task => {
                    tasksContainer.appendChild(task);
                });
            }


            function toggleTasks() {
                document.querySelector(".split-container").classList.toggle("show-tasks");
                
                let buttonText = document.querySelector(".tasks-button button");
                buttonText.textContent = buttonText.textContent === "📝" ? "✍🏼" : "📝";
                
                anime({
                    targets: '.tasks-container',
                    translateX: [
                        { value: '0%', easing: 'easeInOutQuad', duration: 500 },
                    ],
                });
            }
            function updateSelectColor(selectElement) {
                const selectedValue = selectElement.value;
                switch (selectedValue) {
                    case "low":
                        selectElement.style.color = "green";
                        break;
                    case "medium":
                        selectElement.style.color = "orange";
                        break;
                    case "high":
                        selectElement.style.color = "red";
                        break;
                }
            }

            // Call the updateSelectColor function when the page loads
            window.onload = () => {
                const prioritySelect = document.querySelector("select[name='priority']");
                updateSelectColor(prioritySelect);
            };

        </script>
    </body>
</html>
