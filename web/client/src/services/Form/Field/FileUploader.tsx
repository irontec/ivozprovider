import { Button } from '@mui/material';
import { PropertySpec } from "services/Api/ParsedApiSpecInterface";
import CustomComponentWrapper from "./CustomComponentWrapper";
import BackupIcon from '@mui/icons-material/Backup';
import { ChangeEvent, DragEvent, useCallback, useState } from 'react';
import { StyledFileUploaderContainer, StyledFileNameContainer, StyledUploadButtonContainer, StyledUploadButtonLabel } from './FileUploader.styles';

interface ViewValueProps {
    columnName: string,
    property: PropertySpec,
    values: any,
    changeHandler: Function,
}

const FileUploader = (props: ViewValueProps) => {

    let { property, columnName, values, changeHandler } = props;

    const [hover, setHover] = useState<boolean>(false);
    const [hoverCount, setHoverCount] = useState<number>(0);

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

                        changeHandler({
                            target: {
                                name: columnName,
                                value: value,
                            }
                        });
                    }}
                />
                <StyledUploadButtonContainer>
                    <StyledUploadButtonLabel htmlFor={id}>
                        <Button variant="contained" component="span">
                            <BackupIcon />
                        </Button>
                    </StyledUploadButtonLabel>
                </StyledUploadButtonContainer>
                {fileName && <StyledFileNameContainer>{fileName} ({fileSizeMb}MB)</StyledFileNameContainer>}
            </StyledFileUploaderContainer>

        </CustomComponentWrapper >
    );
}

export default FileUploader;