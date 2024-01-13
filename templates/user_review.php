<div class="row">
    <div class="col-md-12 review">
        <div class="row">
            <div class="col-md-1">
                <div class="profile-image-container review-image" style="background-image: url('<?= $BASE_URL ?>img/users/<?= $review["user"]->image ?? "user.png" ?>');"></div>
            </div>
            <div class="col-md-9 author-details-container">
                <a href="">
                    <h4 class="author-name">
                        <?= $review["user"]->name ?>
                    </h4>
                </a>
                <p>
                    <i class="fas fa-star"></i> <?= $review["review"]->rating ?>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="comment-title">Comentário:</p>
                <p><?= $review["review"]->review ?></p>
            </div>
        </div>
    </div>
</div>