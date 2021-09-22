import { Button, makeStyles } from '@material-ui/core';
import { PropertySpec } from "services/Api/ParsedApiSpecInterface";
import CustomComponentWrapper from "./CustomComponentWrapper";
import BackupIcon from '@material-ui/icons/Backup';
import { ChangeEvent, DragEvent, useCallback, useRef, useState } from 'react';

interface ViewValueProps {
    columnName: string,
    property: PropertySpec,
    values: any,
    changeHandler: Function,
}

interface makeStylesProps {
    hover: boolean
}

const FileUploader = (props: ViewValueProps) => {

    let { property, columnName, values, changeHandler } = props;

    const [hover, setHover] = useState(false);
    const dragZoneRef = useRef(null);

    const handleDragEnter = useCallback(
        (e: DragEvent) => {
            e.preventDefault();
            e.stopPropagation();

            setHover(true);
        },
        [],
    );

    const handleDragOver = useCallback(
        (e: DragEvent) => {
            e.preventDefault();
            e.stopPropagation();
        },
        [],
    );

    const handleDragLeave = useCallback(
        (e: DragEvent) => {
            e.preventDefault();
            e.stopPropagation();

            setHover(false);
        },
        [],
    );

    type fileContainerEvent = Pick<ChangeEvent<{ files: FileList }>, 'target'>

    const onChange = useCallback<{ (event: fileContainerEvent): void }>(
        (event: fileContainerEvent) => {

            const files = event.target.files || [];
            if (!files.length) {
                return;
            }

            const value = {
                ...values[columnName],
                ...{ file: files[0] }
            };

            changeHandler({
                target: {
                    name: columnName,
                    value: value,
                }
            });
        },
        [changeHandler, columnName, values],
    );

    const handleDrop = useCallback(
        (e: DragEvent) => {
            e.preventDefault();
            e.stopPropagation();

            setHover(false);

            const event = {
                target: {
                    files: e.dataTransfer.files
                }
            };

            onChange(
                event as fileContainerEvent
            );
        },
        [onChange],
    );


    const classes = useStyles({
        hover
    });

    const id = `${columnName}-file-upload`;
    const fileName = values[columnName]?.file
        ? values[columnName].file?.name
        : values[columnName]?.baseName;

    const fileSize = values[columnName]?.file
        ? values[columnName].file?.size
        : values[columnName]?.fileSize;

    const fileSizeMb = Math.round(fileSize / 1024 / 1024 * 10) / 10;

    return (
        <CustomComponentWrapper property={property}>
            <div
                className={classes.container}
                ref={dragZoneRef}
                onDrop={handleDrop}
                onDragEnter={handleDragEnter}
                onDragLeave={handleDragLeave}
                onDragOver={handleDragOver}
            >
                <input
                    className={classes.displayNone}
                    id={id}
                    type="file"
                    onChange={(event) => {

                        const files = event.target.files || [];
                        const value = {
                            ...values[columnName],
                            ...{ file: files[0] }
                        };

                        changeHandler({
                            target: {
                                name: columnName,
                                value: value,
                            }
                        });
                    }}
                />
                <div className={classes.uploadButtonContainer}>
                    < label
                        htmlFor={id}
                        className={classes.button}
                    >
                        <Button variant="contained" color="primary" component="span">
                            <BackupIcon />
                        </Button>
                    </label>
                </div>
                {fileName && <div className={classes.fileName}>{fileName} ({fileSizeMb}MB)</div>}
            </div>

        </CustomComponentWrapper >
    );
}

const useStyles = makeStyles((theme: any) => ({
    container: {
        display: 'flex',
        flexDirection: 'row-reverse',
        alignItems: 'flex-end',
        justifyContent: 'space-between',
        opacity: (props: makeStylesProps) => props.hover ? 0.5 : 1,
        "& *": {
            pointerEvents: 'none',
        }
    },
    fileName: {
        alignItems: 'flex-start',
        flexGrow: 1,
        alignSelf: 'center',
    },
    uploadButtonContainer: {
        alignSelf: 'center',
        alignItems: 'flex-end',
    },
    button: {
        cursor: 'pointer',
    },
    displayNone: {
        display: 'none',
    }
}));

export default FileUploader;