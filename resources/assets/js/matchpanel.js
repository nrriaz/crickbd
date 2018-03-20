require('./bootstrap');

var matchpanel=new Vue({
   el:'#match-panel',
    data:{
       match_id:'',
       isExtraBall:false,
        match_data:{
           "match_id":'',
            "user_id":'',
            "over":'',
            "location":"",
            "player_total":'',
            "toss_winner":'',
            "first_innings":'',
            "start_time":"",
            "created_at":"",
            "updated_at":"",
            "teams":[
                {"team_id":'',"team_name":"","match_id":'','players':[]},
                {"team_id":'',"team_name":"","match_id":'','players':[]}
                ]
       },
        on_strike:'',
        bowler:''
    },
    created:function(){
       this.match_id=this.getMatchID();
        this.getMatchData();
    },
    methods:{
       getMatchID:function(){
           var url=window.location.href;
           for(var i=url.length-1;i>=0;i--){
               if(url[i]=='/'){
                   break;
               }
           }
           return Number(url.slice(i+1));
       },
       getMatchData:function(){
           var mainthis=this;
            axios.get('/getmatchdata/'+mainthis.match_id)
                .then(function (response) {
                    mainthis.match_data=response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        insertTossData:function(){
            axios.post('/getmatchdata/match/settoss',{
                match_id:this.match_data.match_id,
                toss_winner:this.match_data.toss_winner,
                first_team:this.match_data.first_innings
                })
                .then(function(response){
                    console.log(response);
                })
                .catch(function(error){
                    console.log(error);
                });
        }
    }
});