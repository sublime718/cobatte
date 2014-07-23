<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<div class="gheight"></div>
<section id="bo_w">
    
	<div class="writebox havebtn">

		<h2 id="container_title"><?php echo $g5['title'] ?></h2>

		<form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
		<input type="hidden" name="w" value="<?php echo $w ?>">
		<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
		<input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
		<input type="hidden" name="sca" value="<?php echo $sca ?>">
		<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
		<input type="hidden" name="stx" value="<?php echo $stx ?>">
		<input type="hidden" name="spt" value="<?php echo $spt ?>">
		<input type="hidden" name="sst" value="<?php echo $sst ?>">
		<input type="hidden" name="sod" value="<?php echo $sod ?>">
		<input type="hidden" name="page" value="<?php echo $page ?>">
		<?php
		$option = '';
		$option_hidden = '';
		if ($is_notice || $is_html || $is_secret || $is_mail) {
			$option = '';
			if ($is_notice) {
				$option .= PHP_EOL.'<input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'>'.PHP_EOL.'<label for="notice">공지</label>';
			}

			if ($is_html) {
				if ($is_dhtml_editor) {
					$option_hidden .= '<input type="hidden" value="html1" name="html">';
				} else {
					$option .= PHP_EOL.'<input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'.PHP_EOL.'<label for="html">html</label>';
				}
			}

			if ($is_secret) {
				if ($is_admin || $is_secret==1) {
					$option .= PHP_EOL.'<input type="checkbox" id="secret" name="secret" value="secret" '.$secret_checked.'>'.PHP_EOL.'<label for="secret">비밀글</label>';
				} else {
					$option_hidden .= '<input type="hidden" name="secret" value="secret">';
				}
			}

			if ($is_mail) {
				$option .= PHP_EOL.'<input type="checkbox" id="mail" name="mail" value="mail" '.$recv_email_checked.'>'.PHP_EOL.'<label for="mail">답변메일받기</label>';
			}
		}

		echo $option_hidden;
		?>

		<div class="inputbox">
		<fieldset>
			<legend><?php echo $g5['title'] ?></legend>
			
			<?php if ($is_name) { ?>
			<p class="inputnt">
				<strong class="sound_only"><label for="wr_name">이름</label></strong>
				<input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required itemname="이름" placeholder="이름" class="frm_input required" maxlength="20">
			</p>
			<?php } ?>

			<?php if ($is_password) { ?>
			<p class="inputnt">
				<strong class="sound_only"><label for="wr_password">패스워드</label></strong>
				<input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> itemname="패스워드" placeholder="패스워드" class="frm_input <?php echo $password_required ?>" maxlength="20">
			</p>
			<?php } ?>

			<?php if ($is_email) { ?>
			<p class="inputnt">
				<strong class="sound_only"><label for="wr_email">이메일</label></strong>
				<input type="email" name="wr_email" value="<?php echo $email ?>" id="wr_email" itemname="이메일" placeholder="이메일" class="frm_input email" maxlength="100">
			</p>
			<?php } ?>

			<?php if ($is_homepage) { ?>
			<p class="inputnt">
				<strong class="sound_only"><label for="wr_homepage">홈페이지주소</label></strong>
				<input type="url" name="wr_homepage" value="<?php echo $homepage ?>" id="wr_homepage" itemname="홈페이지주소" placeholder="홈페이지주소" class="frm_input">
			</p>
			<?php } ?>

			<?php if ($option) { ?>
			<p class="inputnt">
				<?php echo $option ?>
			</p>
			<?php } ?>

			<?php if ($is_category) { ?>
			<p class="inputnt">
				<strong class="sound_only"><label for="ca_name">분류선택</label></strong>
				<select class="required" id="ca_name" name="ca_name" required>
					<option value="">선택하세요</option>
					<?php echo $category_option ?>
				</select>
			</p>
			<?php } ?>

			<p class="inputnt">
				<strong class="sound_only"><label for="wr_subject">제목필수</label></strong>
				<input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" placeholder="제목" required class="frm_input required">
			</p>

			<p class="inputarea">
				<strong class="sound_only"><label for="wr_subject">내용필수</label></strong>
				<?php if($write_min || $write_max) { ?>
				<!-- 최소/최대 글자 수 사용 시 -->
				<p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
				<?php } ?>
				<?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
				<?php if($write_min || $write_max) { ?>
				<!-- 최소/최대 글자 수 사용 시 -->
				<div id="char_count_wrap"><span id="char_count"></span>글자</div>
				<?php } ?>
			</p>

			<?php for ($i=1; $is_link && $i<=G5_LINK_COUNT; $i++) { ?>
			<p class="inputnt">
				<strong class="sound_only"><label for="wr_link<?php echo $i ?>">링크 #<?php echo $i ?></label></strong>
				<input type="url" name="wr_link<?php echo $i ?>" value="<?php if($w=="u"){echo$write['wr_link'.$i];} ?>" id="wr_link<?php echo $i ?>" placeholder="링크 #<?php echo $i ?>" class="frm_input wr_link">
			</p>
			<?php } ?>

			<?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
				<p class="inputnt">
					<strong class="sound_only">파일 #<?php echo $i+1 ?></strong>
					<input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> :  용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input">
				</p>
				
				<?php if ($is_file_content) { ?>
				<p class="inputnt">
					<input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" placeholder="파일 설명을 입력해주세요." class="frm_file frm_input">
				<p>
				<?php } ?>
				<?php if($w == 'u' && $file[$i]['file']) { ?>
				<p class="inputnt">
					<input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i; ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')'; ?> 파일 삭제</label>
				</p>
				<?php } ?>
			<?php } ?>

			<?php if ($is_guest) { //자동등록방지 ?>
				<strong class="sound_only">자동등록방지</strong>
				<?php echo $captcha_html ?>
			<?php } ?>

		</fieldset>
		</div>

		<div class="btm-btns">
			<div class="lbtns" style="width: 50%;"><button type="submit" id="btn_submit"><span class="sbmt">작성완료</span></button></div>
			<div class="lbtns" style="width: 50%;"><button type="button" id="btn_list" onclick="location.href='./board.php?bo_table=<?=$bo_table?>&<?php echo $qstr; ?>'"><span>목록으로</span></button></div>
		</div>

		</form>
	
	</div>

</section>

<script>
<?php if($write_min || $write_max) { ?>
// 글자수 제한
var char_min = parseInt(<?php echo $write_min; ?>); // 최소
var char_max = parseInt(<?php echo $write_max; ?>); // 최대
check_byte("wr_content", "char_count");

$(function() {
    $("#wr_content").on("keyup", function() {
        check_byte("wr_content", "char_count");
    });
});

<?php } ?>
function html_auto_br(obj)
{
    if (obj.checked) {
        result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
        if (result)
            obj.value = "html2";
        else
            obj.value = "html1";
    }
    else
        obj.value = "";
}

function fwrite_submit(f)
{
    <?php echo get_editor_js('wr_content', $is_dhtml_editor); ?>
    <?php echo chk_editor_js('wr_content', $is_dhtml_editor); ?>

    var subject = "";
    var content = "";
    $.ajax({
        url: g5_bbs_url+"/ajax.filter.php",
        type: "POST",
        data: {
            "subject": f.wr_subject.value,
            "content": f.wr_content.value
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function(data, textStatus) {
            subject = data.subject;
            content = data.content;
        }
    });

    if (subject) {
        alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
        f.wr_subject.focus();
        return false;
    }

    if (content) {
        alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
        if (typeof(ed_wr_content) != "undefined")
            ed_wr_content.returnFalse();
        else
            f.wr_content.focus();
        return false;
    }

    if (document.getElementById("char_count")) {
        if (char_min > 0 || char_max > 0) {
            var cnt = parseInt(check_byte("wr_content", "char_count"));
            if (char_min > 0 && char_min > cnt) {
                alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                return false;
            }
            else if (char_max > 0 && char_max < cnt) {
                alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                return false;
            }
        }
    }

    <?php if ($is_guest) { echo chk_captcha_js(); } ?>

    document.getElementById("btn_submit").disabled = "disabled";

    return true;
}
</script>