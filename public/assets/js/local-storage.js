let storage = {
    set: function (key, data){
        localStorage.setItem(key, JSON.stringify(data))
    },
    get: function (key) {
       let data =  localStorage.getItem(key)
        if(data){
            return JSON.parse(data);
        }
        else{
            return {};
        }
    },
    delete: function (key, index) {
          let data = this.get(key);
          if(data[index])
              data.splice(index, 1);
        localStorage.setItem(key, JSON.stringify(data))
    },
    update: function () {

    }
}
