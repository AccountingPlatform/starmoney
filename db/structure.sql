DROP DATABASE IF EXISTS `starmoney`;
CREATE DATABASE `starmoney`;
DROP TABLE IF EXISTS `detail`;
CREATE TABLE `detail` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL COMMENT '日期',
  `type` enum('income','spend') NOT NULL DEFAULT 'spend' COMMENT 'income收入,spend支出',
  `money` decimal(11,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `note` text COMMENT '事由，备注',
  `operator` varchar(20) DEFAULT '' COMMENT '经办人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='账务明细';