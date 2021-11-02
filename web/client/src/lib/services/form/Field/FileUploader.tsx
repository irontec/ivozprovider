import { Button } from '@mui/material';
import { FkProperty } from "lib/services/api/ParsedApiSpecInterface";
import CustomComponentWrapper from "./CustomComponentWrapper";
import BackupIcon from '@mui/icons-material/Backup';
import { ChangeEvent, DragEvent, MouseEvent, useCallback, useState } from 'react';
import { StyledFileUploaderContainer, StyledFileNameContainer, StyledUploadButtonContainer, StyledUploadButtonLabel, StyledDownloadingIcon } from './FileUploader.styles';
import { FormOnChangeEvent } from 'lib/entities/DefaultEntityBehavior';
import { useStoreActions } from 'store';
import { saveAs } from 'file-saver';

interface FileUploaderProps {
    columnName: string,
    property: FkProperty,
    values: any,
    changeHandler: (e: FormOnChangeEvent) => void,
    downloadPath: string | null
}

const FileUploader = (props: FileUploaderProps): JSX.Element => {

    const { property, columnName, values, changeHandler, downloadPath } = props;
    if (!downloadPath) {
        console.error('Empty download path');
    }

    const apiDownload = useStoreActions((actions) => {
        return actions.api.download;
    });

    const [hover, setHover] = useState<boolean>(false);
    const [hoverCount, setHoverCount] = useState<number>(0);
    const [downloading, setDownloading] = useState<boolean>(false);

    const handleDragEnter = useCallback(
        (e: DragEvent) => {
            e.preventDefault();
            e.stopPropagation();

            setHover(hoverCount >= 0);
            setHoverCount(hoverCount + 1);
        },
        [hoverCount],
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

            setHover(hoverCount > 1);
            setHoverCount(hoverCount - 1);
        },
        [hoverCount],
    );

    const handleDownload = useCallback(
        async (e: MouseEvent) => {

            if (downloading) {
                return;
            }

            setDownloading(true);

            e.preventDefault();
            e.stopPropagation();

            try {
                await apiDownload({
                    path: downloadPath as string,
                    params: {},
                    successCallback: async (data: any, headers: any) => {
                        const fileName = headers['content-disposition'].split('filename=').pop();
                        saveAs(data, fileName);
                    }
                });
            } finally {
                setDownloading(false);
            }

        },
        [downloading, downloadPath, apiDownload],
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

            const changeEvent = {
                target: {
                    name: columnName,
                    value: value,
                }
            } as ChangeEvent<HTMLInputElement>;
            changeHandler(changeEvent);
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
            <StyledFileUploaderContainer
                hover={hover}
                onDrop={handleDrop}
                onDragEnter={handleDragEnter}
                onDragLeave={handleDragLeave}
                onDragOver={handleDragOver}
            >
                <input
                    style={{ display: 'none' }}
                    id={id}
                    type="file"
                    onChange={(event) => {

                        const files = event.target.files || [];
                        const value = {
                            ...values[columnName],
                            ...{ file: files[0] }
                        };

                        const changeEvent = {
                            target: {
                                name: columnName,
                                value: value,
                            }
                        } as ChangeEvent<HTMLInputElement>;
                        changeHandler(changeEvent);
                    }}
                />
                <StyledUploadButtonContainer>
                    <StyledUploadButtonLabel htmlFor={id}>
                        <Button variant="contained" component="span">
                            <BackupIcon />
                        </Button>
                    </StyledUploadButtonLabel>
                </StyledUploadButtonContainer>
                {fileName &&
                    <>
                        <StyledFileNameContainer>
                            {values.id && <StyledDownloadingIcon onClick={handleDownload} />}
                            {fileName} ({fileSizeMb}MB)
                        </StyledFileNameContainer>
                    </>
                }
            </StyledFileUploaderContainer>

        </CustomComponentWrapper >
    );
}

export default FileUploader;