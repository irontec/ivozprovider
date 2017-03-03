/**
 * Allow IVREntries to be defined as regular expressions. Previously only one
 * digit was allowed.
 */
ALTER TABLE `IVRCustomEntries` MODIFY `entry` VARCHAR(40) NOT NULL;
