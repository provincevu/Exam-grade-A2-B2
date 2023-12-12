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
});