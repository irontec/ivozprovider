import {
  StyledFileNameContainer,
  StyledFileUploaderContainer,
  StyledUploadButtonLabel,
} from '@irontec-voip/ivoz-ui/services/form/Field/FileUploader/FileUploader.styles';
import BackupIcon from '@mui/icons-material/Backup';
import { Button } from '@mui/material';
import { styled } from '@mui/styles';
import React, { useState } from 'react';

interface FileUploadProps {
  onFileSelect: (file: File) => void;
}

const StyledUplader = styled(StyledFileUploaderContainer)({
  display: 'flex',
  flexDirection: 'column',
});

const FileUpload: React.FC<FileUploadProps> = ({ onFileSelect }) => {
  const [file, setFile] = useState<File | null>(null);

  const handleFileChange = (event: React.ChangeEvent<HTMLInputElement>) => {
    const selectedFile = event.target.files && event.target.files[0];
    if (selectedFile) {
      setFile(selectedFile);
      onFileSelect(selectedFile);
    }
  };

  return (
    <StyledUplader>
      <input
        style={{ display: 'none' }}
        id='file-uploader'
        type='file'
        onChange={handleFileChange}
      />
      {!file && (
        <StyledUploadButtonLabel htmlFor={'file-uploader'}>
          <Button variant='contained' component='span'>
            <BackupIcon />
          </Button>
        </StyledUploadButtonLabel>
      )}
      {file && <StyledFileNameContainer>{file.name}</StyledFileNameContainer>}
    </StyledUplader>
  );
};

export default FileUpload;
