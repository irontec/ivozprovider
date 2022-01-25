import { styled } from '@mui/styles';
import { useRef } from "react";
import DownloadingIcon from '@mui/icons-material/Downloading';

export const StyledFileUploaderContainer = styled(
    (props) => {

        const { children, className } = props;
        const { onDrop, onDragEnter, onDragLeave, onDragOver } = props;

        const dragZoneRef = useRef(null);

        return (
            <div
                className={className}
                ref={dragZoneRef}
                onDrop={onDrop}
                onDragEnter={onDragEnter}
                onDragLeave={onDragLeave}
                onDragOver={onDragOver}
            >
                {children}
            </div>
        );
    }
)(
    ({ hover }: { hover: boolean }) => {

        return {
            display: 'flex',
            flexDirection: 'row-reverse',
            alignItems: 'flex-end',
            justifyContent: 'space-between',
            opacity: (hover ? 0.5 : 1)
        }
    }
);

export const StyledDownloadingIcon = styled(DownloadingIcon)({
    verticalAlign: 'bottom',
    cursor: 'pointer',
    marginRight: '5px',
});

export const StyledUploadButtonContainer = styled('div')({
    alignSelf: 'center',
    alignItems: 'flex-end',
});

export const StyledUploadButtonLabel = styled(
    (props) => {
        const { children, className, htmlFor } = props;
        return (
            <label
                htmlFor={htmlFor}
                className={className}
            >
                {children}
            </label>
        );
    }
)({
    cursor: 'pointer',
});

export const StyledFileNameContainer = styled('div')({
    alignItems: 'flex-start',
    flexGrow: 1,
    alignSelf: 'center',
    '&.disabled': {
        color: 'rgba(0, 0, 0, 0.5)',
    }
});


