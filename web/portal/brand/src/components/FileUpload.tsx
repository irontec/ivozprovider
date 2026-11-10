import {
  StyledFileNameContainer,
  StyledFileUploaderContainer,
  StyledUploadButtonLabel,
} from '@irontec/ivoz-ui/services/form/Field/FileUploader/FileUploader.styles';
import BackupIcon from '@mui/icons-material/Backup';
import { Button } from '@mui/material';
import { styled } from '@mui/styles';
import React, { useState } from 'react';

interface FileUploadProps {
  onFileSelect: (file: File) => void;
  accept?: string;
}

const StyledUploader = styled(StyledFileUploaderContainer)({
  display: 'flex',
  flexDirection: 'column',
});

const FileUpload: React.FC<FileUploadProps> = ({ onFileSelect, accept }) => {
  const [file, setFile] = useState<File | null>(null);

  const handleFileChange = (event: React.ChangeEvent<HTMLInputElement>) => {
    const selectedFile = event.target.files && event.target.files[0];
    if (selectedFile) {
      setFile(selectedFile);
      onFileSelect(selectedFile);
    }
  };

  return (
    <StyledUploader>
      <input
        style={{ display: 'none' }}
        id='file-uploader'
        type='file'
        accept={accept}
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
    </StyledUploader>
  );
};

export default FileUpload;
