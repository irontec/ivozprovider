import { Button } from '@mui/material';
import BackupIcon from '@mui/icons-material/Backup';
import { ChangeEvent, DragEvent, MouseEvent, useCallback, useState } from 'react';
import { StyledFileUploaderContainer, StyledFileNameContainer, StyledUploadButtonContainer, StyledUploadButtonLabel, StyledDownloadingIcon } from './FileUploader.styles';
import { useStoreActions } from 'store';
import { saveAs } from 'file-saver';
import withCustomComponentWrapper, { PropertyCustomFunctionComponentProps } from '../CustomComponentWrapper';

interface fileProps {
    file?: File,
    baseName?: string,
    fileSize?: number,
}

interface ChangeEventValues {
    name: string,
    value: fileProps,
}

interface FileUploaderProps<T> extends PropertyCustomFunctionComponentProps<T> {
    downloadPath: string | null
}

type FileUploaderPropsType = FileUploaderProps<{ [k: string]: fileProps }>;

const FileUploader: React.FunctionComponent<FileUploaderPropsType> = (props): JSX.Element => {

    const {
        _columnName,
        values,
        downloadPath,
        disabled,
        changeHandler,
        onBlur
    } = props;

    const fileValue = values[_columnName] as fileProps;

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
                ...fileValue,
                ...{ file: files[0] }
            };

            const changeEvent = {
                target: {
                    name: _columnName,
                    value: value,
                }
            } as ChangeEvent<ChangeEventValues>;
            changeHandler(changeEvent);
        },
        [changeHandler, _columnName, fileValue],
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

    const id = `${_columnName}-file-upload`;
    const fileName = fileValue?.file
        ? fileValue.file?.name
        : fileValue?.baseName;

    const fileSize = fileValue?.file
        ? fileValue.file?.size
        : fileValue?.fileSize;

    const fileSizeMb = Math.round((fileSize || 0) / 1024 / 1024 * 10) / 10;

    return (
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
                        ...fileValue,
                        ...{ file: files[0] }
                    };

                    const changeEvent = {
                        target: {
                            name: _columnName,
                            value: value,
                        }
                    } as ChangeEvent<ChangeEventValues>;

                    changeHandler(changeEvent);
                    onBlur(changeEvent as any);
                }}
            />
            {!disabled && <StyledUploadButtonContainer>
                <StyledUploadButtonLabel htmlFor={id}>
                    <Button variant="contained" component="span">
                        <BackupIcon />
                    </Button>
                </StyledUploadButtonLabel>
            </StyledUploadButtonContainer>}
            {fileName &&
                <>
                    <StyledFileNameContainer className={disabled ? 'disabled' : ''}>
                        {values.id && <StyledDownloadingIcon onClick={handleDownload} />}
                        {fileName} ({fileSizeMb}MB)
                    </StyledFileNameContainer>
                </>
            }
        </StyledFileUploaderContainer>
    );
}

export default withCustomComponentWrapper<FileUploaderPropsType, FileUploaderProps<FileUploaderPropsType>>(FileUploader);