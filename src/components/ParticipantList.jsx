import React, { useState, useCallback, useEffect, useRef } from 'react';

const ParticipantList = ({ participants }) => {
  const [participantImageLoading, setParticipantImageLoading] = useState(
    participants.reduce((acc, participant) => {
      acc[participant.id] = true;
      return acc;
    }, {})
  );

  const imageRefs = useRef({});

  const handleImageLoad = useCallback((participantId) => {
    setParticipantImageLoading(prev => ({
      ...prev,
      [participantId]: false
    }));
  }, []);

  const handleImageError = useCallback((participantId) => {
    setParticipantImageLoading(prev => ({
      ...prev,
      [participantId]: false
    }));
  }, []);

  // Reset loading state when participants change and check if images are already loaded
  useEffect(() => {
    const newLoadingState = participants.reduce((acc, participant) => {
      acc[participant.id] = true;
      return acc;
    }, {});

    setParticipantImageLoading(newLoadingState);

    // Check if images are already loaded (e.g., from cache)
    participants.forEach(participant => {
      const imgRef = imageRefs.current[participant.id];
      if (imgRef && imgRef.complete && imgRef.naturalHeight > 0) {
        setParticipantImageLoading(prev => ({
          ...prev,
          [participant.id]: false
        }));
      }
    });
  }, [participants]);

  // Additional effect to handle cached images that might not trigger onLoad
  useEffect(() => {
    const checkLoadedImages = () => {
      participants.forEach(participant => {
        const imgRef = imageRefs.current[participant.id];
        if (imgRef && imgRef.complete && imgRef.naturalHeight > 0 && participantImageLoading[participant.id]) {
          setParticipantImageLoading(prev => ({
            ...prev,
            [participant.id]: false
          }));
        }
      });
    };

    // Check immediately and then periodically
    checkLoadedImages();
    const interval = setInterval(checkLoadedImages, 100);

    return () => clearInterval(interval);
  }, [participants, participantImageLoading]);

  return (
    <div className="participant-list">
      {participants.map(participant => (
        <div key={participant.id} className="participant-item">
          {participantImageLoading[participant.id] ? (
            <div className="shimmer-placeholder" />
          ) : (
            <img
              ref={el => imageRefs.current[participant.id] = el}
              src={participant.imageUrl}
              alt={participant.name}
              onLoad={() => handleImageLoad(participant.id)}
              onError={() => handleImageError(participant.id)}
            />
          )}
          <span>{participant.name}</span>
        </div>
      ))}
    </div>
  );
};

export default ParticipantList;
