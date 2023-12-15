document.addEventListener('DOMContentLoaded', function(){
    //hiện info
    document.addEventListener('click', function(e){
        const info = document.querySelector('#info');
        const showInfo = document.querySelector('#showInfo');

        if (e.target !== showInfo && !info.contains(e.target)) {
            info.style.display = 'none';
        } 
        if (e.target === showInfo) {
            info.style.display = 'block';
        }
    });
    //hiện ảnh
    document.addEventListener('click', function(e){
        const anh_dai_dien = document.querySelector('#anh_dai_dien');
        const showImage = document.querySelector('#showImage');

        if (e.target !== showImage && !anh_dai_dien.contains(e.target)) {
            anh_dai_dien.style.display = 'none';
        } 
        if (e.target === showImage) {
            anh_dai_dien.style.display = 'block';
        }
    });
    document.addEventListener('click', function(e){
        const projects = document.querySelector('#projects');
        const members = document.querySelector('#members');
        const my_projects = document.querySelector('#my_projects');
        const discuss = document.querySelector('#discuss');
        if (e.target === projects){
            projects.style.backgroundColor = '#4c9beb'
            members.style.backgroundColor = 'white'
            my_projects.style.backgroundColor = 'white'
            discuss.style.backgroundColor = 'white'
        }
        else if (e.target === members){
            projects.style.backgroundColor = 'white'
            members.style.backgroundColor = '#4c9beb'
            my_projects.style.backgroundColor = 'white'
            discuss.style.backgroundColor = 'white'
        }
        else if (e.target === my_projects){
            projects.style.backgroundColor = 'white'
            members.style.backgroundColor = 'white'
            my_projects.style.backgroundColor = '#4c9beb'
            discuss.style.backgroundColor = 'white'
        }
        else if(e.target === discuss){
            projects.style.backgroundColor = 'white'
            members.style.backgroundColor = 'white'
            my_projects.style.backgroundColor = 'white'
            discuss.style.backgroundColor = '#4c9beb'
        }
    })
    document.addEventListener('click', function(e){
        const is_comming = document.querySelector('#is_comming');
        const to_do = document.querySelector('#to_do');
        const completed = document.querySelector('#completed');
        const project_is_comming = document.querySelectorAll('#project_is_comming');
        const project_to_do = document.querySelectorAll('#project_to_do');
        const project_completed = document.querySelectorAll('#project_completed');

        if (e.target == is_comming) {
            is_comming.style.borderBottom = '5px solid grey';
            to_do.style.borderBottom = 'none';
            completed.style.borderBottom = 'none';
            Array.from(project_is_comming).forEach(function(e) {
                e.style.display = 'block';
            });
            Array.from(project_to_do).forEach(function(e) {
                e.style.display = 'none';
            });
            Array.from(project_completed).forEach(function(e) {
                e.style.display = 'none';
            });
        } else if (e.target == to_do) {
            to_do.style.borderBottom = '5px solid grey';
            is_comming.style.borderBottom = 'none';
            completed.style.borderBottom = 'none';
            Array.from(project_is_comming).forEach(function(e) {
                e.style.display = 'none';
            });
            Array.from(project_to_do).forEach(function(e) {
                e.style.display = 'block';
            });
            Array.from(project_completed).forEach(function(e) {
                e.style.display = 'none';
            });
        } else if (e.target == completed) {
            completed.style.borderBottom = '5px solid grey';
            to_do.style.borderBottom = 'none';
            is_comming.style.borderBottom = 'none';
            Array.from(project_is_comming).forEach(function(e) {
                e.style.display = 'none';
            });
            Array.from(project_to_do).forEach(function(e) {
                e.style.display = 'none';
            });
            Array.from(project_completed).forEach(function(e) {
                e.style.display = 'block';
            });
        }
    })
});