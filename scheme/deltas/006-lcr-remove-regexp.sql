ALTER TABLE `OutgoingRouting` DROP regexp;
ALTER TABLE `OutgoingRouting` MODIFY `type` enum('pattern','group') DEFAULT 'group';
