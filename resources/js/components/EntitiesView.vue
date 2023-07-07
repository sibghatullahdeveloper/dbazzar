<template>
    <div class="container border-r mt-5">
        <h1 class="heading-color pt-3">Cricket Deals - Up to 70% off</h1>

                    <div class="container-foulid pb-3">

            <div class="row">

                <div class="col-xl-4 col-lg-4 col-md-6 pt-3 col-sm-12 col-12"  v-for="item in list">
                    <div class="border-r p-3">

<!--                            <section class="variable-width slider pt-2  tab-slider ">-->
                        <div class="row" >
                            <div   v-for="pic in item.pictures" >
                                <img :src="'images/entitybranch/'+ pic.picture" width="110px" height="60px" style="padding-left: 6px;">
                            </div>
                        </div>

<!--                        </section>-->

                     <h6 class="pt-2">{{item.title}} </h6>
                        <div class="row">
                        <div class="btn-group btn-group-sm" style="padding-left: 10px;">
                                   <button type="button" class="btn btn-dark bs" v-for="(item, key) in item.entity_settings" v-if="key == 'delivery_time'">
                                       {{item}} min
                         </button>
                        </div>
                        <div class="btn-group btn-group-sm" v-for="tags in item.tags_name">
                                <button type="button" class="btn btn-dark bs">#{{tags.name}}</button>
                        </div>
                        </div>

                        <br>
                        <h6 class="pt-3"><i class="fas fa-star"></i> <b> 4.2</b> <span class="time">{{item.branch_time}}</span> </h6>
                    </div>
                </div>
                </div>
           <infinite-loading @distance="1" @infinite="infiniteHandler"></infinite-loading>
        </div>

    </div>


</template>

<script type="text/javascript">

    export default {

        mounted() {
            console.log('Component mounted.')

        },
        data() {
            return {
                list: [],
                page: 1,
            };
        },
        methods: {
            infiniteHandler($state) {
                let vm = this;
                this.$http.get('/EntityBranchList?page='+this.page)
                    .then(response => {
                        return response.json();
                    }).then(data => {
                    $.each(data.data, function(key, value) {
                        vm.list.push(value);
                    });
                    $state.loaded();
                });

                this.page = this.page + 1;
            },
        },
    }

    $(document).ready(function() {
        $('.variable-width').slick({
            speed: 1000,
            slidesToScroll: 3,
            slidesToShow: 3,
            autoplay: true,
            arrows: false,
            dots: false,

        });
        $('.slider-img').slick({
            slidesToShow: 3,
            slidesToScroll: 3,
            autoplay: true,
            autoplaySpeed: 500000,
        });
    });

</script>

