<div>
	<button type="button" id="predict" class="btn btn-primary" onclick="callStackML()">Predict</button>
	<br>
    <br>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="thumbnail">
        			<img id="image" src="<?php echo base_url(); ?>/assets/images/<?php echo $upload_data['file_name']; ?>">
                    
                    <div class="caption">
                        <p>INPUT IMAGE</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="thumbnail" >
                    <canvas id="outputCanvas" ></canvas>
                    <div class="caption">
                        <p>OUTPUT IMAGE</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
</div>
<script>
readURL(this);

    async function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#image').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}



async function callStackML() {
        //provide the access key
    await stackml.init({'accessKeyId': 'cc67bf312d822468f0c174c18f57f7a7'});

// load Face Expression Recognition model
const model1 = await stackml.faceDetection(callbackLoad);
const model2 = await stackml.faceExpression(callbackLoad);

// make prediction with the image
model2.detect(document.getElementById('image'), callbackPredict);




function callbackLoad() {
    console.log('callback after face expression model is loaded!');
}

// callback after prediction
function callbackPredict(err, results) {
    
    if(err) 
        console.log(err);

    console.log(results);

    var canv = document.getElementById('outputCanvas');
    canv.width = document.getElementById('image').width;
    canv.height = document.getElementById('image').height;
    var contxt = canv.getContext('2d');

    // draw output keypoints in the image
    contxt.drawImage(document.getElementById('image'),10,10);
    

    var emoji = {
                    angry: '<?php echo base_url(); ?>assets/images/angry.png',
                    surprised: '<?php echo base_url(); ?>assets/images/surprised.png',
                    happy: '<?php echo base_url(); ?>assets/images/happy.png',
                    sad: '<?php echo base_url(); ?>assets/images/sad.png',
                    disgusted: '<?php echo base_url(); ?>assets/images/disgusted.png',
                    fearful: '<?php echo base_url(); ?>assets/images/fearful.png',
                    neutral: '<?php echo base_url(); ?>assets/images/neutral.png'
                };

            const loadImage = url => {
            return new Promise((resolve, reject) => {
                const im = new Image();
                im.onload = () => resolve(im);
                im.onerror = () => reject(new Error(`load ${url} fail`));
                im.src = url;
            });
            };

            results.outputs.forEach((result, i) => {
                var maxProbability = Math.max.apply(Math, result.expressions.map(function(o) {return o.probability;}));
                var expression = result.expressions.find(function(o){return o.probability == maxProbability});
                
                loadImage(emoji[expression.expression]).then(image => contxt.drawImage(image, result.detection.box.x, result.detection.box.y, result.detection.box.width, result.detection.box.height));
            });
    }
}
</script>