IS_VIDEO -> is_video
update nl_postmeta set meta_key = 'is_video' where meta_key = 'IS_VIDEO';

VIDEO_ID -> video_id
update nl_postmeta set meta_key = 'video_id' where meta_key = 'VIDEO_ID';

VIDEO_PROVIDER -> video_provider
update nl_postmeta set meta_key = 'video_provider' where meta_key = 'VIDEO_PROVIDER';

576P_VIDEO_URL -> 576p_video_url
update nl_postmeta set meta_key = '576p_video_url' where meta_key = '576P_VIDEO_URL';

720P_VIDEO_URL -> 720p_video_url
update nl_postmeta set meta_key = '720p_video_url' where meta_key = '720P_VIDEO_URL';

1080P_VIDEO_URL -> 1080p_video_url
update nl_postmeta set meta_key = '1080p_video_url' where meta_key = '1080P_VIDEO_URL';

CARTEL ->cartel
update nl_postmeta set meta_key = 'cartel' where meta_key = 'CARTEL';

BEGINDATE -> begin_date
update nl_postmeta set meta_key = 'begin_date' where meta_key = 'BEGINDATE';

ENDDATE -> end_date
update nl_postmeta set meta_key = 'end_date' where meta_key = 'ENDDATE';

PLACE -> place
update nl_postmeta set meta_key = 'place' where meta_key = 'PLACE';

update nl_postmeta set meta_key = 'latt' where meta_key = 'LATT';
update nl_postmeta set meta_key = 'long' where meta_key = 'LONG';
